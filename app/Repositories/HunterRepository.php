<?php

namespace App\Repositories;

use App\Interfaces\IHunterRepository;
use App\Models\Hunter;
use Illuminate\Database\Eloquent\Builder;

/**
 * Eloquent implementation of IHunterRepository.
 *
 * Inherits CRUD operations from base class.
 * Add Hunter-specific methods here if needed.
 */
class HunterRepository extends CrudRepository implements IHunterRepository
{
    protected array $filterable = ['campaignId', 'class'];

    public function __construct(Hunter $hunter)
    {
        parent::__construct($hunter);
    }

    protected function applyUserScope(Builder $query, string $userId): void
    {
        $query->where('userId', $userId);
    }

    public function countByCampaignId(string $campaignId): int
    {
        return $this->model->where('campaignId', $campaignId)->count();
    }
}
