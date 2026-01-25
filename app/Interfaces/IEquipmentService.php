<?php

namespace App\Interfaces;

use App\Models\Equipment;

/**
 * Equipment-specific service interface.
 *
 * Extends generic CRUD operations and can define Equipment-specific methods.
 *
 * @extends ICrudService<Equipment>
 */
interface IEquipmentService extends ICrudService
{
    // Add Equipment-specific service methods here if needed
}
