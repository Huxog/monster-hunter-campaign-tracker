<?php

namespace App\Interfaces;

use App\Models\Hunter;

/**
 * Hunter-specific repository interface.
 *
 * Extends generic CRUD operations and can define Hunter-specific methods.
 *
 * @extends ICrudRepository<Hunter>
 */
interface IHunterRepository extends ICrudRepository
{
    public function countByCampaignId(string $campaignId): int;
}
