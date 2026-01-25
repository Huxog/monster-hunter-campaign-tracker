<?php

namespace App\Repositories;

use App\Interfaces\ICrudRepository;
use Illuminate\Database\Eloquent\Collection;
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
    public function __construct(
        protected Model $model
    ) {}

    public function all(array $relations = []): Collection
    {
        return $this->model->with($relations)->get();
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
