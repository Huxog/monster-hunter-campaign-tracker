<?php

namespace App\Repositories;

use App\Interfaces\ICampaignRepository;
use App\Models\Campaign;

/**
 * Eloquent implementation of ICampaignRepository.
 *
 * Inherits CRUD operations from base class.
 * Add Campaign-specific methods here if needed.
 */
class CampaignRepository extends CrudRepository implements ICampaignRepository
{
    protected array $filterable = ['mapId'];

    public function __construct(Campaign $campaign)
    {
        parent::__construct($campaign);
    }
}
