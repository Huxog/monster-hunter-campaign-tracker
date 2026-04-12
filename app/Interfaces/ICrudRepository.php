<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Generic CRUD repository interface.
 *
 * Provides standard data access operations that can be extended
 * by entity-specific interfaces for additional methods.
 *
 * @template T of Model
 */
interface ICrudRepository
{
    /**
     * Get paginated records, optionally filtered.
     *
     * @param  array<string, mixed>  $filters
     * @param  array<string>  $relations
     * @return LengthAwarePaginator<T>
     */
    public function all(array $filters = [], int $perPage = 15, array $relations = []): LengthAwarePaginator;

    /**
     * Find a record by ID.
     *
     * @param  array<string>  $relations
     * @return T|null
     */
    public function find(string $id, array $relations = []): ?Model;

    /**
     * Find a record by ID or throw exception.
     *
     * @param  array<string>  $relations
     * @return T
     */
    public function findOrFail(string $id, array $relations = []): Model;

    /**
     * Create a new record.
     *
     * @param  array<string, mixed>  $data
     * @return T
     */
    public function create(array $data): Model;

    /**
     * Update an existing record.
     *
     * @param  T  $model
     * @param  array<string, mixed>  $data
     * @return T
     */
    public function update(Model $model, array $data): Model;

    /**
     * Delete a record.
     *
     * @param  T  $model
     */
    public function delete(Model $model): bool;
}
