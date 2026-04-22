<?php

namespace App\Http\Controllers;

use App\Http\Requests\CampaignStore;
use App\Http\Requests\CampaignUpdate;
use App\Http\Resources\CampaignCollection;
use App\Http\Resources\CampaignResource;
use App\Http\Resources\MaterialCollection;
use App\Interfaces\ICampaignService;
use App\Models\Campaign;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
     * Players only see campaigns where they have a hunter.
     * Admins see all campaigns.
     *
     * @authenticated
     *
     * @queryParam mapId string Filter by map UUID. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     * @queryParam page integer Page number to retrieve. Defaults to 1. Example: 1
     * @queryParam per_page integer Number of results per page (max 100). Defaults to 15. Example: 15
     */
    public function index(Request $request): CampaignCollection
    {
        $filters = array_filter($request->only(['mapId']));

        if ($userId = $this->scopedUserId()) {
            $filters['userId'] = $userId;
        }

        return new CampaignCollection($this->campaignService->getAll($filters, $this->perPage($request)));
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
     * Display aggregated loot across all hunters in a campaign.
     *
     * Returns each unique material with the total quantity held across all hunters.
     *
     * @authenticated
     */
    public function loot(Campaign $campaign): MaterialCollection
    {
        return new MaterialCollection($this->campaignService->getLoot($campaign->id));
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
