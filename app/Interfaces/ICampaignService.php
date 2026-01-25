<?php

namespace App\Interfaces;

use App\Models\Campaign;

/**
 * Campaign-specific service interface.
 *
 * Extends generic CRUD operations and can define Campaign-specific methods.
 *
 * @extends ICrudService<Campaign>
 */
interface ICampaignService extends ICrudService
{
    // Add Campaign-specific methods here if needed
}
