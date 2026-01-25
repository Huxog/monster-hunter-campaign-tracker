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
    // Define default relations to eager load (optional)
    // protected array $defaultRelations = [];

    public function __construct(IEquipmentRepository $repository)
    {
        parent::__construct($repository);
    }

    // Add Equipment-specific business logic here if needed
}
