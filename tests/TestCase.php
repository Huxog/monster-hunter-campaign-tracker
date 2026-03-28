<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Spatie\Permission\Models\Role;

abstract class TestCase extends BaseTestCase
{
    protected function asAdmin(): User
    {
        $user = User::factory()->create();
        Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $user->assignRole('admin');
        $this->actingAs($user);

        return $user;
    }

    protected function asPlayer(): User
    {
        $user = User::factory()->create();
        Role::firstOrCreate(['name' => 'player', 'guard_name' => 'web']);
        $user->assignRole('player');
        $this->actingAs($user);

        return $user;
    }
}
