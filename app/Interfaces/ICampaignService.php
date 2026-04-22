<?php

namespace App\Interfaces;

use App\Models\Campaign;
use Illuminate\Support\Collection;

/**
 * Campaign-specific service interface.
 *
 * Extends generic CRUD operations and can define Campaign-specific methods.
 *
 * @extends ICrudService<Campaign>
 */
interface ICampaignService extends ICrudService
{
    public function getLoot(string $campaignId): Collection;
}
