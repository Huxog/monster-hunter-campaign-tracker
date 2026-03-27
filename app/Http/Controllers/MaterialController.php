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
     */
    public function index(): MaterialCollection
    {
        return new MaterialCollection($this->materialService->getAll());
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
