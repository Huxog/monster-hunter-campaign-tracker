<?php

namespace App\Interfaces;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;

/**
 * Generic CRUD service interface.
 *
 * Provides standard business operations that can be extended
 * by entity-specific interfaces for additional methods.
 *
 * @template T of Model
 */
interface ICrudService
{
    /**
     * Get paginated records, optionally filtered.
     *
     * @param  array<string, mixed>  $filters
     * @return LengthAwarePaginator<T>
     */
    public function getAll(array $filters = [], int $perPage = 15): LengthAwarePaginator;

    /**
     * Get a record by ID.
     *
     * @return T
     */
    public function getById(string $id): Model;

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
     * @param  array<string, mixed>  $data
     * @return T
     */
    public function update(array $data, string $id): Model;

    /**
     * Delete a record.
     *
     * @return T
     */
    public function delete(string $id): Model;
}
