<?php

namespace App\Repositories;

use App\Interfaces\IMapRepository;
use App\Interfaces\Repositories\MapRepositoryInterface;
use App\Models\Map;

/**
 * Eloquent implementation of MapRepositoryInterface.
 *
 * Inherits CRUD operations from base class.
 * Add Map-specific methods here if needed.
 */
class MapRepository extends CrudRepository implements IMapRepository
{
    public function __construct(Map $map)
    {
        parent::__construct($map);
    }

    // Add Map-specific methods here if needed
    // Example:
    // public function findByName(string $name): ?Map
    // {
    //     return $this->model->where('name', $name)->first();
    // }
}
