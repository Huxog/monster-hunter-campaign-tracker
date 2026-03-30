<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestStore;
use App\Http\Requests\QuestUpdate;
use App\Http\Resources\QuestCollection;
use App\Http\Resources\QuestResource;
use App\Interfaces\IQuestService;
use App\Models\Quest;
use App\Traits\FormatExceptionResponse;
use Illuminate\Http\JsonResponse;
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
     * @authenticated
     *
     * @queryParam sort string Field to sort by. Defaults to 'id'
     * @queryParam direction string Direction of the sorting 'asc'/'desc'
     */
    public function index(): QuestCollection
    {
        return new QuestCollection($this->questService->getAll());
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
