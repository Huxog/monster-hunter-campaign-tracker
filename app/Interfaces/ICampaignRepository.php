<?php

namespace App\Interfaces;

use App\Models\Campaign;

/**
 * Campaign-specific repository interface.
 *
 * Extends generic CRUD operations and can define Campaign-specific methods.
 *
 * @extends ICrudRepository<Campaign>
 */
interface ICampaignRepository extends ICrudRepository
{
    // Add Campaign-specific methods here if needed
    // Example: public function findByMapId(int $mapId): Collection;
}
