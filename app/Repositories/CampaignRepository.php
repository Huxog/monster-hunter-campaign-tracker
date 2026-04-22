<?php

namespace App\Repositories;

use App\Interfaces\ICampaignRepository;
use App\Models\Campaign;
use App\Models\Material;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

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

    public function getLootByCampaignId(string $campaignId): Collection
    {
        return Material::query()
            ->select('materials.*')
            ->selectRaw('SUM(loot.quantity) as quantity')
            ->join('loot', 'materials.id', '=', 'loot.materialId')
            ->join('hunters', 'loot.hunterId', '=', 'hunters.id')
            ->where('hunters.campaignId', $campaignId)
            ->whereNull('hunters.deleted_at')
            ->groupBy('materials.id')
            ->get();
    }
}
