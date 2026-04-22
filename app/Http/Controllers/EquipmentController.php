<?php

namespace App\Http\Controllers;

use App\Http\Requests\EquipmentStore;
use App\Http\Requests\EquipmentUpdate;
use App\Http\Resources\EquipmentCollection;
use App\Http\Resources\EquipmentResource;
use App\Interfaces\IEquipmentService;
use App\Models\Equipment;
use App\Traits\FormatExceptionResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Equipment
 *
 * Endpoints for managing equipment
 */
class EquipmentController extends Controller
{
    use FormatExceptionResponse;

    public function __construct(
        private IEquipmentService $equipmentService
    ) {}

    /**
     * Display a listing of equipment.
     *
     * @authenticated
     *
     * @queryParam type string Filter by equipment type (helmet, vest, trouser). Example: helmet
     * @queryParam class string Filter by weapon class compatibility. Example: GreatSword
     * @queryParam page integer Page number to retrieve. Defaults to 1. Example: 1
     * @queryParam per_page integer Number of results per page (max 100). Defaults to 15. Example: 15
     */
    public function index(Request $request): EquipmentCollection
    {
        $filters = array_filter($request->only(['type', 'class']));

        return new EquipmentCollection($this->equipmentService->getAll($filters, $this->perPage($request)));
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
