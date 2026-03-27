<?php

namespace App\Repositories;

use App\Interfaces\IMaterialRepository;
use App\Models\Material;

/**
 * Eloquent implementation of IMaterialRepository.
 *
 * Inherits CRUD operations from base class.
 * Add Material-specific methods here if needed.
 */
class MaterialRepository extends CrudRepository implements IMaterialRepository
{
    public function __construct(Material $model)
    {
        parent::__construct($model);
    }

    // Add Material-specific repository methods here if needed
}
