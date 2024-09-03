<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculatePriceTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_calculate_price_endpoint_with_valid_data()
    {
        $response = $this->withHeaders([
            'x-api-key' => '123456',
        ])->postJson('/api/calculate', [
            'addresses' => [
                [
                    'country' => 'DE',
                    'zip' => '10115',
                    'city' => 'Berlin'
                ],
                [
                    'country' => 'DE',
                    'zip' => '20095',
                    'city' => 'Hamburg'
                ]
            ]
        ]);



        $response->assertStatus(200)
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'vehicle_type',
                        'price',
                    ]
                ]
            ]);
    }
}
