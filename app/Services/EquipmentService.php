<?php

namespace App\Services;

use App\Interfaces\IEquipmentRepository;
use App\Interfaces\IEquipmentService;

/**
 * Equipment service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add Equipment-specific business logic here if needed.
 */
class EquipmentService extends CrudService implements IEquipmentService
{
    protected array $defaultRelations = ['materials'];

    public function __construct(IEquipmentRepository $repository)
    {
        parent::__construct($repository);
    }
}
