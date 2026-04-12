<?php

namespace App\Repositories;

use App\Interfaces\IEquipmentRepository;
use App\Models\Equipment;

/**
 * Eloquent implementation of IEquipmentRepository.
 *
 * Inherits CRUD operations from base class.
 * Add Equipment-specific methods here if needed.
 */
class EquipmentRepository extends CrudRepository implements IEquipmentRepository
{
    protected array $filterable = ['type', 'class'];

    public function __construct(Equipment $model)
    {
        parent::__construct($model);
    }

    // Add Equipment-specific repository methods here if needed
}
