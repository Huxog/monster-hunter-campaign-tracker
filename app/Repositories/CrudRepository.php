<?php

namespace App\Repositories;

use App\Interfaces\ICrudRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

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
        $query = $this->model->with($relations)->newQuery();

        foreach ($filters as $column => $value) {
            if (in_array($column, $this->filterable, true) && $value !== null && $value !== '') {
                $query->where($column, $value);
            }
        }

        return $query->paginate($perPage);
    }

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