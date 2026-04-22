<?php

namespace App\Repositories;

use App\Interfaces\IQuestRepository;
use App\Models\Quest;
use Illuminate\Database\Eloquent\Builder;

class QuestRepository extends CrudRepository implements IQuestRepository
{
    protected array $filterable = ['campaignId', 'monsterId', 'outcome'];

    public function __construct(Quest $model)
    {
        parent::__construct($model);
    }

    protected function applyUserScope(Builder $query, string $userId): void
    {
        $query->whereHas('campaign.hunters', fn ($q) => $q->where('userId', $userId));
    }
}
