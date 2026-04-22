<?php

namespace App\Services;

use App\Interfaces\IEquipmentRepository;
use App\Interfaces\IEquipmentService;
use App\Traits\SyncsMaterials;

class EquipmentService extends CrudService implements IEquipmentService
{
    use SyncsMaterials;

    protected array $defaultRelations = ['materials'];

    public function __construct(IEquipmentRepository $repository)
    {
        parent::__construct($repository);
    }
}
