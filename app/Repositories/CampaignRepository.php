<?php

namespace App\Repositories;

use App\Interfaces\ICampaignRepository;
use App\Models\Campaign;
use Illuminate\Database\Eloquent\Builder;

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

    protected function applyUserScope(Builder $query, string $userId): void
    {
        $query->whereHas('hunters', fn ($q) => $q->where('userId', $userId));
    }
}
