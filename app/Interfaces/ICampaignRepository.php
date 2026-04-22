<?php

namespace App\Interfaces;

use App\Models\Campaign;
use Illuminate\Support\Collection;

/**
 * Campaign-specific repository interface.
 *
 * Extends generic CRUD operations and can define Campaign-specific methods.
 *
 * @extends ICrudRepository<Campaign>
 */
interface ICampaignRepository extends ICrudRepository
{
    public function getLootByCampaignId(string $campaignId): Collection;
}
