<?php

namespace App\Services;

use App\Exceptions\InsufficientMaterialsException;
use App\Exceptions\RecipeNotFoundException;
use App\Interfaces\IHunterRepository;
use App\Interfaces\IHunterService;
use App\Models\Equipment;
use App\Models\Hunter;
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
            throw new ModelNotFoundException();
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
}
