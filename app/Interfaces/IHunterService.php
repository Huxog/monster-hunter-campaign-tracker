<?php

namespace App\Interfaces;

use App\Models\Hunter;
use Illuminate\Database\Eloquent\Model;

/**
 * Hunter-specific service interface.
 *
 * Extends generic CRUD operations and can define Hunter-specific methods.
 *
 * @extends ICrudService<Hunter>
 */
interface IHunterService extends ICrudService
{
    public function craft(Hunter $hunter, string $craftableType, string $craftableId): Model;
}
