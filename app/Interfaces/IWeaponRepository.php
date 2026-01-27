<?php

namespace App\Interfaces;

use App\Models\Weapon;

/**
 * Weapon-specific repository interface.
 *
 * Extends generic CRUD operations and can define Weapon-specific methods.
 *
 * @extends ICrudRepository<Weapon>
 */
interface IWeaponRepository extends ICrudRepository
{
    // Add Weapon-specific repository methods here if needed
}
