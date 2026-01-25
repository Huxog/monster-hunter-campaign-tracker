<?php

namespace App\Repositories;

use App\Interfaces\IHunterRepository;
use App\Models\Hunter;

/**
 * Eloquent implementation of IHunterRepository.
 *
 * Inherits CRUD operations from base class.
 * Add Hunter-specific methods here if needed.
 */
class HunterRepository extends CrudRepository implements IHunterRepository
{
    public function __construct(Hunter $hunter)
    {
        parent::__construct($hunter);
    }

    // Add Hunter-specific methods here if needed
    // Example:
    // public function findByCampaignId(int $campaignId): Collection
    // {
    //     return $this->model->where('campaignId', $campaignId)->get();
    // }
}
