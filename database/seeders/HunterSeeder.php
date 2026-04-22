<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Hunter;
use App\Models\User;
use Illuminate\Database\Seeder;

class HunterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::role('player')->get();

        Campaign::all()->each(function ($campaign) use ($users) {
            $count = rand(1, min(4, $users->count()));
            $assignedUsers = $users->shuffle()->take($count);

            foreach ($assignedUsers as $user) {
                Hunter::factory()->fullyEquipped()->create([
                    'campaignId' => $campaign->id,
                    'userId' => $user->id,
                    'playerName' => $user->name,
                ]);
            }
        });
    }
}
