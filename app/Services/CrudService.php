<?php

namespace App\Services;

use App\Interfaces\ICrudRepository;
use App\Interfaces\ICrudService;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Abstract base service with common CRUD operations.
 *
 * Entity-specific services extend this class and can add
 * custom methods while inheriting standard CRUD functionality.
 *
 * @template T of Model
 *
 * @implements ICrudService<T>
 */
abstract class CrudService implements ICrudService
{
    /**
     * Default relations to eager load.
     *
     * Override in child classes to customize.
     *
     * @var array<string>
     */
    protected array $defaultRelations = [];

    public function __construct(
        protected ICrudRepository $repository
    ) {}

    public function getAll(array $filters = [], int $perPage = 15): LengthAwarePaginator
    {
        return $this->repository->all($filters, $perPage, $this->defaultRelations);
    }

    public function getById(string $id): Model
    {
        return $this->repository->findOrFail($id, $this->defaultRelations);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(array $data, string $id): Model
    {
        $model = $this->repository->findOrFail($id);

        return $this->repository->update($model, $data);
    }

    public function delete(string $id): Model
    {
        $model = $this->repository->findOrFail($id);
        $this->repository->delete($model);

        return $model;
    }
}
