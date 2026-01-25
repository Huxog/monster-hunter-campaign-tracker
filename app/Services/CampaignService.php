<?php

namespace App\Services;

use App\Interfaces\ICampaignRepository;
use App\Interfaces\ICampaignService;

/**
 * Campaign service implementation.
 *
 * Inherits CRUD operations from base class.
 * Add Campaign-specific business logic here if needed.
 */
class CampaignService extends CrudService implements ICampaignService
{
    protected array $defaultRelations = ['map', 'hunters'];

    public function __construct(ICampaignRepository $repository)
    {
        parent::__construct($repository);
    }

    // Add Campaign-specific business logic here if needed
}
