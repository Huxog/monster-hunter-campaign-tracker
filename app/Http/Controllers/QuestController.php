<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestStore;
use App\Http\Requests\QuestUpdate;
use App\Http\Resources\QuestCollection;
use App\Http\Resources\QuestResource;
use App\Interfaces\IQuestService;
use App\Models\Campaign;
use App\Models\Quest;
use App\Traits\FormatExceptionResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Quests
 *
 * Endpoints for managing quests
 */
class QuestController extends Controller
{
    use FormatExceptionResponse;

    public function __construct(private IQuestService $questService) {}

    /**
     * Display a listing of quests.
     *
     * Players only see quests in campaigns where they have a hunter.
     * Admins see all quests.
     *
     * @authenticated
     *
     * @queryParam campaignId string Filter by campaign UUID. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     * @queryParam monsterId string Filter by monster UUID. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     * @queryParam outcome string Filter by quest outcome. Example: success
     * @queryParam page integer Page number to retrieve. Defaults to 1. Example: 1
     * @queryParam per_page integer Number of results per page (max 100). Defaults to 15. Example: 15
     */
    public function index(Request $request): QuestCollection
    {
        $filters = array_filter($request->only(['campaignId', 'monsterId', 'outcome']));

        if ($userId = $this->scopedUserId()) {
            $filters['userId'] = $userId;
        }

        return new QuestCollection($this->questService->getAll($filters, $this->perPage($request)));
    }

    /**
     * Display a listing of quests belonging to a campaign.
     *
     * @authenticated
     *
     * @queryParam monsterId string Filter by monster UUID. Example: 019bf2f1-70b4-70e2-abd2-83879497461b
     * @queryParam outcome string Filter by quest outcome. Example: success
     * @queryParam page integer Page number to retrieve. Defaults to 1. Example: 1
     * @queryParam per_page integer Number of results per page (max 100). Defaults to 15. Example: 15
     */
    public function indexByCampaign(Campaign $campaign, Request $request): QuestCollection
    {
        $filters = array_filter($request->only(['monsterId', 'outcome']));
        $filters['campaignId'] = $campaign->id;

        return new QuestCollection($this->questService->getAll($filters, $this->perPage($request)));
    }

    /**
     * Store a newly created quest in storage.
     *
     * @authenticated
     */
    public function store(QuestStore $request): JsonResponse
    {
        $quest = $this->questService->create($request->validated());

        return (new QuestResource($quest))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified quest.
     *
     * @authenticated
     */
    public function show(Quest $quest): QuestResource
    {
        return new QuestResource($this->questService->getById($quest->id));
    }

    /**
     * Update the specified quest in storage.
     *
     * @authenticated
     */
    public function update(QuestUpdate $request, Quest $quest): QuestResource
    {
        return new QuestResource($this->questService->update($request->validated(), $quest->id));
    }

    /**
     * Remove the specified quest from storage.
     *
     * @authenticated
     */
    public function destroy(Quest $quest): QuestResource
    {
        return new QuestResource($this->questService->delete($quest->id));
    }
}
