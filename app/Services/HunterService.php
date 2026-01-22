<?php

namespace App\Services;

use App\Interfaces\IHunterService;
use App\Interfaces\IHunterRepository;

/**
 * Hunter service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add Hunter-specific business logic here if needed.
 */
class HunterService extends CrudService implements IHunterService
{
    protected array $defaultRelations = ['campaign'];

    public function __construct(IHunterRepository $repository)
    {
        parent::__construct($repository);
    }

    // Add Hunter-specific business logic here if needed
}
