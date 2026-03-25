<?php

namespace App\Interfaces;

use App\Models\Material;

/**
 * Material-specific service interface.
 *
 * Extends generic CRUD operations and can define Material-specific methods.
 *
 * @extends ICrudService<Material>
 */
interface IMaterialService extends ICrudService
{
    // Add Material-specific service methods here if needed
}
