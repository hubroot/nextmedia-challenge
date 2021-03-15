<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_create_product()
    {
        $response = $this->withHeaders([
            'X-Header' => 'Value',
        ])->post('/products/create', ['name' => 'Sally']);

        $response->assertStatus(201);
    }
}
