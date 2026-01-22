<?php

namespace App\Services;

use App\Interfaces\CrudRepositoryInterface;
use App\Interfaces\ICrudRepository;
use App\Interfaces\ICrudService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Abstract base service with common CRUD operations.
 *
 * Entity-specific services extend this class and can add
 * custom methods while inheriting standard CRUD functionality.
 *
 * @template T of Model
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

    public function getAll(): Collection
    {
        return $this->repository->all($this->defaultRelations);
    }

    public function getById(int $id): Model
    {
        return $this->repository->findOrFail($id, $this->defaultRelations);
    }

    public function create(array $data): Model
    {
        return $this->repository->create($data);
    }

    public function update(array $data, int $id): Model
    {
        $model = $this->repository->findOrFail($id);

        return $this->repository->update($model, $data);
    }

    public function delete(int $id): Model
    {
        $model = $this->repository->findOrFail($id);
        $this->repository->delete($model);

        return $model;
    }
}
