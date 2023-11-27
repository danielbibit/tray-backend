<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\User;
use Tests\TestCase;

class SellerFeatureTest extends TestCase
{
    public function test_the_application_returns_a_successful_response(): void
    {
        $user = User::factory()->create();


        $response = $this->actingAs($user)->withSession(['banned' => false])->get('/api/seller');

        $response->assertStatus(200);
    }

    public function test_root_seller_return_list(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->withSession(['banned' => false])->get('/api/seller');

    }
}
