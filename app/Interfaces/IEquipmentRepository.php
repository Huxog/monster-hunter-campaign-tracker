<?php

namespace App\Interfaces;

use App\Models\Equipment;

/**
 * Equipment-specific repository interface.
 *
 * Extends generic CRUD operations and can define Equipment-specific methods.
 *
 * @extends ICrudRepository<Equipment>
 */
interface IEquipmentRepository extends ICrudRepository
{
    // Add Equipment-specific repository methods here if needed
}
