<?php

namespace App\Http\Controllers;

use App\Http\Requests\MonsterStore;
use App\Http\Requests\MonsterUpdate;
use App\Http\Resources\MonsterCollection;
use App\Http\Resources\MonsterResource;
use App\Interfaces\IMonsterService;
use App\Models\Monster;
use App\Traits\FormatExceptionResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Monsters
 *
 * Endpoints for managing monsters
 */
class MonsterController extends Controller
{
    use FormatExceptionResponse;

    public function __construct(private IMonsterService $monsterService) {}

    /**
     * Display a listing of monsters.
     *
     * @authenticated
     *
     * @queryParam sort string Field to sort by. Defaults to 'id'
     * @queryParam direction string Direction of the sorting 'asc'/'desc'
     */
    public function index(): MonsterCollection
    {
        return new MonsterCollection($this->monsterService->getAll());
    }

    /**
     * Store a newly created monster in storage.
     *
     * @authenticated
     */
    public function store(MonsterStore $request): JsonResponse
    {
        $monster = $this->monsterService->create($request->validated());

        return (new MonsterResource($monster))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Display the specified monster.
     *
     * @authenticated
     */
    public function show(Monster $monster): MonsterResource
    {
        return new MonsterResource($this->monsterService->getById($monster->id));
    }

    /**
     * Update the specified monster in storage.
     *
     * @authenticated
     */
    public function update(MonsterUpdate $request, Monster $monster): MonsterResource
    {
        return new MonsterResource($this->monsterService->update($request->validated(), $monster->id));
    }

    /**
     * Remove the specified monster from storage.
     *
     * @authenticated
     */
    public function destroy(Monster $monster): MonsterResource
    {
        return new MonsterResource($this->monsterService->delete($monster->id));
    }
}
