<?php

namespace App\Http\Controllers;

use App\Http\Requests\WeaponStore;
use App\Http\Requests\WeaponUpdate;
use App\Http\Resources\WeaponCollection;
use App\Http\Resources\WeaponResource;
use App\Interfaces\IWeaponService;
use App\Models\Weapon;
use Illuminate\Http\JsonResponse;

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
     */
    public function index(): WeaponCollection
    {
        return new WeaponCollection($this->weaponService->getAll());
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
