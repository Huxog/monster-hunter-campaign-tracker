<?php

namespace Database\Seeders;

use App\Enums\QuestOutcome;
use App\Models\Campaign;
use App\Models\Hunter;
use App\Models\Monster;
use App\Models\Quest;
use Illuminate\Database\Seeder;

class QuestSeeder extends Seeder
{
    public function run(): void
    {
        $campaign = Campaign::first();
        if (! $campaign) {
            return;
        }

        $hunters = Hunter::where('campaignId', $campaign->id)->get();
        if ($hunters->isEmpty()) {
            return;
        }

        $quests = [
            [
                'monsterId' => Monster::where('name', 'Rathalos')->value('id'),
                'outcome' => QuestOutcome::Success->value,
                'completedAt' => now()->subDays(10),
            ],
            [
                'monsterId' => Monster::where('name', 'Nargacuga')->value('id'),
                'outcome' => QuestOutcome::Failure->value,
                'completedAt' => now()->subDays(5),
            ],
            [
                'monsterId' => Monster::where('name', 'Zinogre')->value('id'),
                'outcome' => null,
                'completedAt' => null,
            ],
        ];

        foreach ($quests as $data) {
            if (! $data['monsterId']) {
                continue;
            }

            $quest = Quest::firstOrCreate(
                ['campaignId' => $campaign->id, 'monsterId' => $data['monsterId']],
                ['outcome' => $data['outcome'], 'completedAt' => $data['completedAt']]
            );

            $quest->hunters()->syncWithoutDetaching($hunters->pluck('id'));
        }
    }
}
