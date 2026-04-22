<?php

namespace Tests\Feature\Health;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthTest extends TestCase
{
    use RefreshDatabase;

    public function test_health_endpoint_is_publicly_accessible(): void
    {
        $response = $this->getJson('api/health');

        $response->assertStatus(200);
    }

    public function test_health_endpoint_returns_expected_structure(): void
    {
        $response = $this->getJson('api/health');

        $response->assertJsonStructure([
            'status',
            'checks' => ['database'],
        ]);
    }

    public function test_health_endpoint_returns_ok_when_database_is_reachable(): void
    {
        $response = $this->getJson('api/health');

        $response->assertJson([
            'status' => 'ok',
            'checks' => ['database' => 'ok'],
        ]);
    }

    public function test_health_endpoint_sets_request_id_header(): void
    {
        $response = $this->getJson('api/health');

        $response->assertHeader('X-Request-Id');
    }
}
