<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeaponStore;
use App\Http\Requests\WeaponUpdate;
use App\Http\Resources\WeaponCollection;
use App\Http\Resources\WeaponResource;
use App\Interfaces\IWeaponService;
use App\Models\Weapon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Weapons
 *
 * Endpoints for managing weapons
 */
class WeaponController extends Controller
{
    public function __construct(
        private IWeaponService $weaponService
    ) {}

    /**
     * Display a listing of weapons.
     *
     * @authenticated
     *
     * @queryParam class string Filter by weapon class (e.g. GreatSword, Bow). Example: Bow
     * @queryParam element string Filter by elemental type (e.g. Fire, Water). Example: Fire
     * @queryParam page integer Page number to retrieve. Defaults to 1. Example: 1
     * @queryParam per_page integer Number of results per page (max 100). Defaults to 15. Example: 15
     */
    public function index(Request $request): WeaponCollection
    {
        $filters = array_filter($request->only(['class', 'element']));

        return new WeaponCollection($this->weaponService->getAll($filters, $this->perPage($request)));
    }

    /**
     * Store a newly created weapon in storage.
     *
     * @authenticated
     */
    public function store(WeaponStore $request): JsonResponse
    {
        $weapon = $this->weaponService->create($request->validated());

        return (new WeaponResource($weapon))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified weapon.
     *
     * @authenticated
     */
    public function show(Weapon $weapon): WeaponResource
    {
        return new WeaponResource($this->weaponService->getById($weapon->id));
    }

    /**
     * Update the specified weapon in storage.
     *
     * @authenticated
     */
    public function update(WeaponUpdate $request, Weapon $weapon): WeaponResource
    {
        return new WeaponResource($this->weaponService->update($request->validated(), $weapon->id));
    }

    /**
     * Remove the specified weapon from storage.
     *
     * @authenticated
     */
    public function destroy(Weapon $weapon): WeaponResource
    {
        return new WeaponResource($this->weaponService->delete($weapon->id));
    }
}