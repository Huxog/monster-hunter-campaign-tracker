<?php

namespace App\Services;

use App\Exceptions\CampaignHunterLimitException;
use App\Exceptions\InsufficientMaterialsException;
use App\Exceptions\ItemNotInInventoryException;
use App\Exceptions\RecipeNotFoundException;
use App\Interfaces\IHunterRepository;
use App\Interfaces\IHunterService;
use App\Models\Equipment;
use App\Models\Hunter;
use App\Models\Material;
use App\Models\Weapon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

/**
 * Hunter service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add Hunter-specific business logic here if needed.
 */
class HunterService extends CrudService implements IHunterService
{
    protected array $defaultRelations = ['campaign', 'helmet', 'vest', 'trousers', 'weapon'];

    public function __construct(IHunterRepository $repository)
    {
        parent::__construct($repository);
    }

    /** Full relation set used whenever a hunter sub-action needs to return updated state. */
    private const FULL_RELATIONS = [
        'campaign', 'helmet', 'vest', 'trousers', 'weapon',
        'loot', 'inventoryWeapons', 'inventoryEquipment',
    ];

    /**
     * Enforce the 4-hunter cap per campaign before creating.
     *
     * @throws CampaignHunterLimitException
     */
    public function create(array $data): Model
    {
        if ($this->repository->countByCampaignId($data['campaignId']) >= 4) {
            throw new CampaignHunterLimitException;
        }

        return parent::create($data);
    }

    /**
     * Load loot and inventory relations on show only.
     * Avoids loading collection data on index listings.
     */
    public function getById(string $id): Model
    {
        return $this->repository->findOrFail($id, [
            'campaign', 'helmet', 'vest', 'trousers', 'weapon',
            'loot', 'inventoryWeapons', 'inventoryEquipment',
        ]);
    }

    /**
     * Craft a weapon or equipment item for the given hunter.
     *
     * Validates material sufficiency before writing to the database.
     * On success, deducts required materials from loot and adds the
     * crafted item to the hunter's inventory.
     *
     * @throws ModelNotFoundException if the craftable item does not exist
     * @throws RecipeNotFoundException if the item has no recipe
     * @throws InsufficientMaterialsException if the hunter lacks required materials
     */
    public function craft(Hunter $hunter, string $craftableType, string $craftableId): Model
    {
        $modelClass = ['weapon' => Weapon::class, 'equipment' => Equipment::class][$craftableType];

        $craftable = $modelClass::with('materials')->find($craftableId);

        if ($craftable === null) {
            throw new ModelNotFoundException;
        }

        if ($craftable->materials->isEmpty()) {
            throw new RecipeNotFoundException($craftableId);
        }

        $loot = $hunter->loot->keyBy('id');

        foreach ($craftable->materials as $required) {
            $held = $loot->get($required->id);
            $heldQty = $held?->pivot->quantity ?? 0;

            if ($heldQty < $required->pivot->quantity) {
                throw new InsufficientMaterialsException($required, $required->pivot->quantity, $heldQty);
            }
        }

        DB::transaction(function () use ($hunter, $craftable, $craftableType) {
            foreach ($craftable->materials as $required) {
                $newQty = $hunter->loot->find($required->id)->pivot->quantity - $required->pivot->quantity;

                if ($newQty <= 0) {
                    $hunter->loot()->detach($required->id);
                } else {
                    $hunter->loot()->updateExistingPivot($required->id, ['quantity' => $newQty]);
                }
            }

            $relation = $craftableType === 'weapon'
                ? $hunter->inventoryWeapons()
                : $hunter->inventoryEquipment();

            $relation->syncWithoutDetaching([$craftable->id]);
        });

        return $craftable;
    }

    /**
     * Add materials to the hunter's loot, incrementing quantity if already present.
     */
    public function addLoot(Hunter $hunter, string $materialId, int $quantity): Hunter
    {
        $existing = $hunter->loot()->wherePivot('materialId', $materialId)->first();

        if ($existing) {
            $hunter->loot()->updateExistingPivot($materialId, [
                'quantity' => $existing->pivot->quantity + $quantity,
            ]);
        } else {
            $hunter->loot()->attach($materialId, ['quantity' => $quantity]);
        }

        return $hunter->load(self::FULL_RELATIONS);
    }

    /**
     * Decrease the quantity of a material in the hunter's loot.
     * Removes the entry entirely if the resulting quantity is zero or below.
     *
     * @throws ModelNotFoundException if the material is not in the hunter's loot
     */
    public function decreaseLoot(Hunter $hunter, Material $material, int $quantity): Hunter
    {
        $existing = $hunter->loot()->wherePivot('materialId', $material->id)->first();

        if ($existing === null) {
            throw new ModelNotFoundException;
        }

        $newQty = $existing->pivot->quantity - $quantity;

        if ($newQty <= 0) {
            $hunter->loot()->detach($material->id);
        } else {
            $hunter->loot()->updateExistingPivot($material->id, ['quantity' => $newQty]);
        }

        return $hunter->load(self::FULL_RELATIONS);
    }

    /**
     * Remove a material entirely from the hunter's loot.
     *
     * @throws ModelNotFoundException if the material is not in the hunter's loot
     */
    public function removeLoot(Hunter $hunter, Material $material): Hunter
    {
        $existing = $hunter->loot()->wherePivot('materialId', $material->id)->first();

        if ($existing === null) {
            throw new ModelNotFoundException;
        }

        $hunter->loot()->detach($material->id);

        return $hunter->load(self::FULL_RELATIONS);
    }

    /**
     * Equip an item from the hunter's inventory into the specified slot.
     *
     * @param  string  $slot  weapon|helmet|vest|trouser
     *
     * @throws ModelNotFoundException if the item does not exist
     * @throws ItemNotInInventoryException if the item is not in the hunter's inventory
     */
    public function equip(Hunter $hunter, string $slot, string $equippableId): Hunter
    {
        $isWeapon = $slot === 'weapon';
        $modelClass = $isWeapon ? Weapon::class : Equipment::class;

        $item = $modelClass::find($equippableId);

        if ($item === null) {
            throw new ModelNotFoundException;
        }

        $inInventory = $isWeapon
            ? $hunter->inventoryWeapons()->where('weapons.id', $equippableId)->exists()
            : $hunter->inventoryEquipment()->where('equipment.id', $equippableId)->where('type', $slot)->exists();

        if (! $inInventory) {
            throw new ItemNotInInventoryException;
        }

        $fkColumn = match ($slot) {
            'weapon' => 'weaponId',
            'helmet' => 'helmetId',
            'vest' => 'vestId',
            'trouser' => 'trousersId',
        };

        $this->repository->update($hunter, [$fkColumn => $equippableId]);

        return $hunter->load(self::FULL_RELATIONS);
    }
}
