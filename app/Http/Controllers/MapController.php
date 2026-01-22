<?php

namespace App\Http\Controllers;

use App\Http\Requests\MapStore;
use App\Http\Requests\MapUpdate;
use App\Http\Resources\MapCollection;
use App\Http\Resources\MapResource;
use App\Interfaces\IMapService;
use App\Models\Map;
use App\Traits\FormatExceptionResponse;
use Illuminate\Http\JsonResponse;

/**
 * @group Maps
 *
 * Endpoints for managing maps
 */
class MapController extends Controller
{
    use FormatExceptionResponse;

    public function __construct(
        private IMapService $mapService
    ) {}

    /**
     * Display a listing of maps.
     *
     * @authenticated
     *
     * @queryParam sort string Field to sort by. Defaults to 'id'
     * @queryParam direction string Direction of the sorting 'asc'/'desc'
     */
    public function index(): MapCollection
    {
        return new MapCollection($this->mapService->getAll());
    }

    /**
     * Store a newly created map in storage.
     *
     * @authenticated
     */
    public function store(MapStore $request): JsonResponse
    {
        $map = $this->mapService->create($request->validated());

        return (new MapResource($map))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified map.
     *
     * @authenticated
     */
    public function show(Map $map): MapResource
    {
        return new MapResource($this->mapService->getById($map->id));
    }

    /**
     * Update the specified map in storage.
     *
     * @authenticated
     */
    public function update(MapUpdate $request, Map $map): MapResource
    {
        return new MapResource($this->mapService->update($request->validated(), $map->id));
    }

    /**
     * Remove the specified map from storage.
     *
     * @authenticated
     */
    public function destroy(Map $map): MapResource
    {
        return new MapResource($this->mapService->delete($map->id));
    }
}
