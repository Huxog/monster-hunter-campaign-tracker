<?php

namespace App\Interfaces;

use App\Models\Weapon;

/**
 * Weapon-specific service interface.
 *
 * Extends generic CRUD operations and can define Weapon-specific methods.
 *
 * @extends ICrudService<Weapon>
 */
interface IWeaponService extends ICrudService
{
    // Add Weapon-specific service methods here if needed
}
