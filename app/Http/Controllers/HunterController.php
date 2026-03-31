<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddLoot;
use App\Http\Requests\CraftItem;
use App\Http\Requests\DecreaseLoot;
use App\Http\Requests\EquipItem;
use App\Http\Requests\HunterStore;
use App\Http\Requests\HunterUpdate;
use App\Http\Resources\EquipmentResource;
use App\Http\Resources\HunterCollection;
use App\Http\Resources\HunterResource;
use App\Http\Resources\WeaponResource;
use App\Interfaces\IHunterService;
use App\Models\Hunter;
use App\Models\Material;
use Illuminate\Http\JsonResponse;

/**
 * @group Hunters
 *
 * Endpoints for managing hunters
 */
class HunterController extends Controller
{
    public function __construct(
        private IHunterService $hunterService
    ) {}

    /**
     * Display a listing of hunters.
     *
     * @authenticated
     *
     * @queryParam sort string Field to sort by. Defaults to 'id'
     * @queryParam direction string Direction of the sorting 'asc'/'desc'
     */
    public function index(): HunterCollection
    {
        return new HunterCollection($this->hunterService->getAll());
    }

    /**
     * Store a newly created hunter in storage.
     *
     * @authenticated
     */
    public function store(HunterStore $request): JsonResponse
    {
        $hunter = $this->hunterService->create($request->validated());

        return (new HunterResource($hunter))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified hunter.
     *
     * @authenticated
     */
    public function show(Hunter $hunter): HunterResource
    {
        return new HunterResource($this->hunterService->getById($hunter->id));
    }

    /**
     * Update the specified hunter in storage.
     *
     * @authenticated
     */
    public function update(HunterUpdate $request, Hunter $hunter): HunterResource
    {
        return new HunterResource($this->hunterService->update($request->validated(), $hunter->id));
    }

    /**
     * Remove the specified hunter from storage.
     *
     * @authenticated
     */
    public function destroy(Hunter $hunter): HunterResource
    {
        return new HunterResource($this->hunterService->delete($hunter->id));
    }

    /**
     * Craft a weapon or equipment item for the specified hunter.
     *
     * @authenticated
     *
     * @bodyParam craftableType string required The type of item to craft (weapon or equipment). Example: weapon
     * @bodyParam craftableId string required The UUID of the item to craft. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     */
    public function craft(CraftItem $request, Hunter $hunter): JsonResponse
    {
        $craftableType = $request->validated('craftableType');

        $craftable = $this->hunterService->craft(
            $hunter,
            $craftableType,
            $request->validated('craftableId'),
        );

        $resource = $craftableType === 'weapon'
            ? new WeaponResource($craftable)
            : new EquipmentResource($craftable);

        return $resource->response()->setStatusCode(JsonResponse::HTTP_OK);
    }

    /**
     * Add materials to the hunter's loot.
     *
     * @authenticated
     *
     * @bodyParam materialId string required UUID of the material to add. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     * @bodyParam quantity integer required Amount to add. Example: 3
     */
    public function addLoot(AddLoot $request, Hunter $hunter): HunterResource
    {
        return new HunterResource($this->hunterService->addLoot(
            $hunter,
            $request->validated('materialId'),
            $request->validated('quantity'),
        ));
    }

    /**
     * Decrease the quantity of a material in the hunter's loot.
     * Removes the entry if the quantity reaches zero.
     *
     * @authenticated
     *
     * @bodyParam quantity integer required Amount to subtract. Example: 2
     */
    public function decreaseLoot(DecreaseLoot $request, Hunter $hunter, Material $material): HunterResource
    {
        return new HunterResource($this->hunterService->decreaseLoot(
            $hunter,
            $material,
            $request->validated('quantity'),
        ));
    }

    /**
     * Remove a material entirely from the hunter's loot.
     *
     * @authenticated
     */
    public function removeLoot(Hunter $hunter, Material $material): HunterResource
    {
        return new HunterResource($this->hunterService->removeLoot($hunter, $material));
    }

    /**
     * Equip a weapon from the hunter's inventory.
     *
     * @authenticated
     *
     * @bodyParam equippableId string required UUID of the weapon to equip. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     */
    public function equipWeapon(EquipItem $request, Hunter $hunter): HunterResource
    {
        return new HunterResource($this->hunterService->equip($hunter, 'weapon', $request->validated('equippableId')));
    }

    /**
     * Equip a helmet from the hunter's inventory.
     *
     * @authenticated
     *
     * @bodyParam equippableId string required UUID of the helmet to equip. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     */
    public function equipHelmet(EquipItem $request, Hunter $hunter): HunterResource
    {
        return new HunterResource($this->hunterService->equip($hunter, 'helmet', $request->validated('equippableId')));
    }

    /**
     * Equip a vest from the hunter's inventory.
     *
     * @authenticated
     *
     * @bodyParam equippableId string required UUID of the vest to equip. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     */
    public function equipVest(EquipItem $request, Hunter $hunter): HunterResource
    {
        return new HunterResource($this->hunterService->equip($hunter, 'vest', $request->validated('equippableId')));
    }

    /**
     * Equip trousers from the hunter's inventory.
     *
     * @authenticated
     *
     * @bodyParam equippableId string required UUID of the trousers to equip. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     */
    public function equipTrouser(EquipItem $request, Hunter $hunter): HunterResource
    {
        return new HunterResource($this->hunterService->equip($hunter, 'trouser', $request->validated('equippableId')));
    }
}
