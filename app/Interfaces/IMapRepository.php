<?php

namespace App\Interfaces;

use App\Models\Map;

/**
 * Map-specific repository interface.
 *
 * Extends generic CRUD operations and can define Map-specific methods.
 *
 * @extends ICrudRepository<Map>
 */
interface IMapRepository extends ICrudRepository
{
    // Add Map-specific methods here if needed
    // Example: public function findByName(string $name): ?Map;
}
