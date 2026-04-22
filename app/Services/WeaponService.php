<?php

namespace App\Services;

use App\Interfaces\IWeaponRepository;
use App\Interfaces\IWeaponService;
use App\Traits\SyncsMaterials;

class WeaponService extends CrudService implements IWeaponService
{
    use SyncsMaterials;

    protected array $defaultRelations = ['hunter', 'materials'];

    public function __construct(IWeaponRepository $repository)
    {
        parent::__construct($repository);
    }
}
