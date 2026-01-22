<?php

namespace App\Interfaces;

use App\Models\Hunter;

/**
 * Hunter-specific service interface.
 *
 * Extends generic CRUD operations and can define Hunter-specific methods.
 *
 * @extends ICrudService<Hunter>
 */
interface IHunterService extends ICrudService
{
    // Add Hunter-specific methods here if needed
}
