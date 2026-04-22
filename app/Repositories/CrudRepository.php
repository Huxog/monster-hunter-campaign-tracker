<?php

namespace App\Repositories;

use App\Interfaces\ICrudRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator as ConcretePaginator;

/**
 * Abstract base repository with common CRUD operations.
 *
 * Entity-specific repositories extend this class and can add
 * custom methods while inheriting standard CRUD functionality.
 *
 * @template T of Model
 *
 * @implements ICrudRepository<T>
 */
abstract class CrudRepository implements ICrudRepository
{
    /**
     * Columns that may be used as equality filters on index queries.
     * Override in entity repositories to enable filtering.
     *
     * @var array<string>
     */
    protected array $filterable = [];

    public function __construct(
        protected Model $model
    ) {}

    public function all(array $filters = [], int $perPage = 15, array $relations = []): LengthAwarePaginator
    {
        $query = $this->model->with($relations)->newQuery()->orderBy('created_at');

        foreach ($filters as $column => $value) {
            if ($column === 'userId' && $value !== null) {
                $this->applyUserScope($query, $value);
            } elseif (in_array($column, $this->filterable, true) && $value !== null && $value !== '') {
                $query->where($column, $value);
            }
        }

        if ($perPage === 0) {
            $results = $query->get();
            $total = $results->count();

            return new ConcretePaginator($results, $total, max($total, 1), 1);
        }

        return $query->paginate($perPage);
    }

    protected function applyUserScope(Builder $query, string $userId): void {}

    public function find(string $id, array $relations = []): ?Model
    {
        return $this->model->with($relations)->find($id);
    }

    public function findOrFail(string $id, array $relations = []): Model
    {
        return $this->model->with($relations)->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }
}
