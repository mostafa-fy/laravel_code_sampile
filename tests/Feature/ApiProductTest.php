<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiProductTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_returns_products(): void
    {
       User::factory()->hasProducts()->create();
        $response = $this->getJson('api/products');

        $response->assertStatus(200);
   
    }
}
