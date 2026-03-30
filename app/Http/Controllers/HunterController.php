<?php

namespace App\Http\Controllers;

use App\Http\Requests\HunterStore;
use App\Http\Requests\HunterUpdate;
use App\Http\Resources\HunterCollection;
use App\Http\Resources\HunterResource;
use App\Interfaces\IHunterService;
use App\Models\Hunter;
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
}
