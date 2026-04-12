<?php

namespace App\Http\Controllers;

use App\Http\Requests\MaterialStore;
use App\Http\Requests\MaterialUpdate;
use App\Http\Resources\MaterialCollection;
use App\Http\Resources\MaterialResource;
use App\Interfaces\IMaterialService;
use App\Models\Material;
use App\Traits\FormatExceptionResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Materials
 *
 * Endpoints for managing materials
 */
class MaterialController extends Controller
{
    use FormatExceptionResponse;

    public function __construct(
        private IMaterialService $materialService
    ) {}

    /**
     * Display a listing of materials.
     *
     * @authenticated
     *
     * @queryParam page integer Page number to retrieve. Defaults to 1. Example: 1
     * @queryParam per_page integer Number of results per page (max 100). Defaults to 15. Example: 15
     */
    public function index(Request $request): MaterialCollection
    {
        return new MaterialCollection($this->materialService->getAll([], $this->perPage($request)));
    }

    /**
     * Store a newly created material in storage.
     *
     * @authenticated
     */
    public function store(MaterialStore $request): JsonResponse
    {
        $material = $this->materialService->create($request->validated());

        return (new MaterialResource($material))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified material.
     *
     * @authenticated
     */
    public function show(Material $material): MaterialResource
    {
        return new MaterialResource($this->materialService->getById($material->id));
    }

    /**
     * Update the specified material in storage.
     *
     * @authenticated
     */
    public function update(MaterialUpdate $request, Material $material): MaterialResource
    {
        return new MaterialResource($this->materialService->update($request->validated(), $material->id));
    }

    /**
     * Remove the specified material from storage.
     *
     * @authenticated
     */
    public function destroy(Material $material): MaterialResource
    {
        return new MaterialResource($this->materialService->delete($material->id));
    }
}