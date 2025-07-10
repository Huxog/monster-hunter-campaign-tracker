<?php

namespace Database\Seeders;

use App\Models\Campaign;
use App\Models\Hunter;
use Illuminate\Database\Seeder;

class HunterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Campaign::all()->each(function ($campaign) {
            Hunter::factory(rand(1, 4))->create([
                'campaignId' => $campaign->id,
            ]);
        });
    }
}
