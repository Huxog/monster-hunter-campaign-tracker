<?php

namespace App\Services;

use App\Interfaces\ICampaignRepository;
use App\Interfaces\ICampaignService;
use Illuminate\Support\Collection;

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

    public function getLoot(string $campaignId): Collection
    {
        return $this->repository->getLootByCampaignId($campaignId);
    }
}
