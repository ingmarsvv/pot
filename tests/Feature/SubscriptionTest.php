<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SubscriptionTest extends TestCase
{
    use RefreshDatabase;
    
    public function test_unauthorized_user_cant_see_subscriptions_redirected(): void{

        $response = $this->get('/subscriptions');

        $response->assertRedirect();
    }

    public function test_unauthorized_user_cant_see_subscriptions_redirected_to_login_route(): void{

        $response = $this->get('/subscriptions');

        $response->assertRedirectToRoute('login');
    }
}
