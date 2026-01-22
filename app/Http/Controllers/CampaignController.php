<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignStore;
use App\Http\Requests\CampaignUpdate;
use App\Http\Resources\CampaignCollection;
use App\Http\Resources\CampaignResource;
use App\Interfaces\ICampaignService;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;

/**
 * @group Campaigns
 *
 * Endpoints for managing campaigns
 */
class CampaignController extends Controller
{
    public function __construct(
        private ICampaignService $campaignService
    ) {}

    /**
     * Display a listing of campaigns.
     *
     * @authenticated
     *
     * @queryParam sort string Field to sort by. Defaults to 'id'
     * @queryParam direction string Direction of the sorting 'asc'/'desc'
     */
    public function index(): CampaignCollection
    {
        return new CampaignCollection($this->campaignService->getAll());
    }

    /**
     * Store a newly created campaign in storage.
     *
     * @authenticated
     */
    public function store(CampaignStore $request): JsonResponse
    {
        $campaign = $this->campaignService->create($request->validated());

        return (new CampaignResource($campaign))
            ->response()
            ->setStatusCode(JsonResponse::HTTP_CREATED);
    }

    /**
     * Display the specified campaign.
     *
     * @authenticated
     */
    public function show(Campaign $campaign): CampaignResource
    {
        return new CampaignResource($this->campaignService->getById($campaign->id));
    }

    /**
     * Update the specified campaign in storage.
     *
     * @authenticated
     */
    public function update(CampaignUpdate $request, Campaign $campaign): CampaignResource
    {
        return new CampaignResource($this->campaignService->update($request->validated(), $campaign->id));
    }

    /**
     * Remove the specified campaign from storage.
     *
     * @authenticated
     */
    public function destroy(Campaign $campaign): CampaignResource
    {
        return new CampaignResource($this->campaignService->delete($campaign->id));
    }
}
