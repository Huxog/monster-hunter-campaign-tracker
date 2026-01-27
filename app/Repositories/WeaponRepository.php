<?php

namespace App\Repositories;

use App\Interfaces\IWeaponRepository;
use App\Models\Weapon;

/**
 * Eloquent implementation of IWeaponRepository.
 *
 * Inherits CRUD operations from base class.
 * Add Weapon-specific methods here if needed.
 */
class WeaponRepository extends CrudRepository implements IWeaponRepository
{
    public function __construct(Weapon $model)
    {
        parent::__construct($model);
    }

    // Add Weapon-specific repository methods here if needed
}
