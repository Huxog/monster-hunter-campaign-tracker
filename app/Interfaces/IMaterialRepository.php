<?php

namespace App\Interfaces;

use App\Models\Material;

/**
 * Material-specific repository interface.
 *
 * Extends generic CRUD operations and can define Material-specific methods.
 *
 * @extends ICrudRepository<Material>
 */
interface IMaterialRepository extends ICrudRepository
{
    // Add Material-specific repository methods here if needed
}
