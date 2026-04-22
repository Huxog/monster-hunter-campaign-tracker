<?php

namespace Database\Seeders;

use App\Enums\QuestOutcome;
use App\Models\Campaign;
use App\Models\Monster;
use App\Models\Quest;
use Illuminate\Database\Seeder;

class QuestSeeder extends Seeder
{
    private array $questPool = [
        ['monster' => 'Rathalos',      'outcome' => QuestOutcome::Success, 'daysAgo' => 30],
        ['monster' => 'Rathian',       'outcome' => QuestOutcome::Success, 'daysAgo' => 25],
        ['monster' => 'Nargacuga',     'outcome' => QuestOutcome::Failure, 'daysAgo' => 20],
        ['monster' => 'Tigrex',        'outcome' => QuestOutcome::Success, 'daysAgo' => 15],
        ['monster' => 'Zinogre',       'outcome' => QuestOutcome::Success, 'daysAgo' => 12],
        ['monster' => 'Diablos',       'outcome' => QuestOutcome::Failure, 'daysAgo' => 8],
        ['monster' => 'Brachydios',    'outcome' => QuestOutcome::Success, 'daysAgo' => 5],
        ['monster' => 'Teostra',       'outcome' => null,                  'daysAgo' => null],
        ['monster' => 'Kushala Daora', 'outcome' => QuestOutcome::Success, 'daysAgo' => 2],
        ['monster' => 'Rajang',        'outcome' => null,                  'daysAgo' => null],
    ];

    private int $questsPerCampaign = 4;

    public function run(): void
    {
        $monsters = Monster::whereIn('name', array_column($this->questPool, 'monster'))
            ->pluck('id', 'name');

        $poolSize = count($this->questPool);

        Campaign::with('hunters')->get()->each(function (Campaign $campaign, int $index) use ($monsters, $poolSize) {
            $hunters = $campaign->hunters;
            if ($hunters->isEmpty()) {
                return;
            }

            $offset = ($index * $this->questsPerCampaign) % $poolSize;
            $slice = array_slice($this->questPool, $offset, $this->questsPerCampaign);

            if (count($slice) < $this->questsPerCampaign) {
                $slice = array_merge($slice, array_slice($this->questPool, 0, $this->questsPerCampaign - count($slice)));
            }

            foreach ($slice as $template) {
                $monsterId = $monsters->get($template['monster']);
                if (! $monsterId) {
                    continue;
                }

                $quest = Quest::firstOrCreate(
                    ['campaignId' => $campaign->id, 'monsterId' => $monsterId],
                    [
                        'outcome' => $template['outcome']?->value,
                        'completedAt' => $template['daysAgo'] !== null ? now()->subDays($template['daysAgo']) : null,
                    ]
                );

                $quest->hunters()->syncWithoutDetaching($hunters->pluck('id'));
            }
        });
    }
}
