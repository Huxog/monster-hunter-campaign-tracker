<?php

namespace App\Services;

use App\Interfaces\IHunterRepository;
use App\Interfaces\IHunterService;

/**
 * Hunter service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add Hunter-specific business logic here if needed.
 */
class HunterService extends CrudService implements IHunterService
{
    protected array $defaultRelations = ['campaign', 'helmet', 'vest', 'trousers', 'weapon'];

    public function __construct(IHunterRepository $repository)
    {
        parent::__construct($repository);
    }

    // Add Hunter-specific business logic here if needed
}
