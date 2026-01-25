<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentStore;
use App\Http\Requests\EquipmentUpdate;
use App\Http\Resources\EquipmentCollection;
use App\Http\Resources\EquipmentResource;
use App\Interfaces\IEquipmentService;
use App\Models\Equipment;
use Illuminate\Http\JsonResponse;

/**
 * @group Equipment
 *
 * Endpoints for managing equipment
 */
class EquipmentController extends Controller
{
    public function __construct(
        private IEquipmentService $equipmentService
    ) {}

    /**
     * Display a listing of equipment.
     *
     * @authenticated
     */
    public function index(): EquipmentCollection
    {
        return new EquipmentCollection($this->equipmentService->getAll());
    }

    /**
     * Store a newly created equipment in storage.
     *
     * @authenticated
     */
    public function store(EquipmentStore $request): JsonResponse
    {
        $equipment = $this->equipmentService->create($request->validated());

        return (new EquipmentResource($equipment))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified equipment.
     *
     * @authenticated
     */
    public function show(Equipment $equipment): EquipmentResource
    {
        return new EquipmentResource($this->equipmentService->getById($equipment->id));
    }

    /**
     * Update the specified equipment in storage.
     *
     * @authenticated
     */
    public function update(EquipmentUpdate $request, Equipment $equipment): EquipmentResource
    {
        return new EquipmentResource($this->equipmentService->update($request->validated(), $equipment->id));
    }

    /**
     * Remove the specified equipment from storage.
     *
     * @authenticated
     */
    public function destroy(Equipment $equipment): EquipmentResource
    {
        return new EquipmentResource($this->equipmentService->delete($equipment->id));
    }
}
