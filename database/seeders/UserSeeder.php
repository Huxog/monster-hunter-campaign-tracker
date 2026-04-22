<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        Role::firstOrCreate(['name' => 'player', 'guard_name' => 'web']);

        $players = [
            ['name' => 'Aria Voss', 'email' => 'aria@mhcampaign.com'],
            ['name' => 'Kael Drummond', 'email' => 'kael@mhcampaign.com'],
            ['name' => 'Nira Stell', 'email' => 'nira@mhcampaign.com'],
            ['name' => 'Oryn Fable', 'email' => 'oryn@mhcampaign.com'],
            ['name' => 'Dusk Maren', 'email' => 'dusk@mhcampaign.com'],
        ];

        foreach ($players as $player) {
            $user = User::firstOrCreate(
                ['email' => $player['email']],
                ['name' => $player['name'], 'password' => 'password']
            );
            $user->assignRole('player');
        }
    }
}
