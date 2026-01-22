<?php

namespace App\Services;

use App\Interfaces\IMapRepository;
use App\Interfaces\IMapService;

/**
 * Map service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add Map-specific business logic here if needed.
 */
class MapService extends CrudService implements IMapService
{
    public function __construct(IMapRepository $repository)
    {
        parent::__construct($repository);
    }

    // Add Map-specific business logic here if needed
}
