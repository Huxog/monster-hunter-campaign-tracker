<?php

namespace App\Services;

use App\Interfaces\IWeaponRepository;
use App\Interfaces\IWeaponService;

/**
 * Weapon service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add Weapon-specific business logic here if needed.
 */
class WeaponService extends CrudService implements IWeaponService
{
    // Define default relations to eager load (optional)
    protected array $defaultRelations = ['hunter'];

    public function __construct(IWeaponRepository $repository)
    {
        parent::__construct($repository);
    }

    // Add Weapon-specific business logic here if needed
}
