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
use Illuminate\Http\Request;
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
     * @queryParam stars integer Filter by difficulty (star rating). Example: 3
     * @queryParam page integer Page number to retrieve. Defaults to 1. Example: 1
     * @queryParam per_page integer Number of results per page (max 100). Defaults to 15. Example: 15
     */
    public function index(Request $request): MonsterCollection
    {
        $filters = array_filter($request->only(['stars']), fn ($v) => $v !== null && $v !== '');

        return new MonsterCollection($this->monsterService->getAll($filters, $this->perPage($request)));
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