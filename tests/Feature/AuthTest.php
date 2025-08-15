<?php

use App\Models\User;

describe('AuthTest flow', function () {
    test('redirect guests to login when accessing the dashboard', function () {
        /** @var \Illuminate\Testing\TestResponse $response */
        $response = $this->get('/dashboard');

        $response->assertRedirect('/login');
    });
    test('Allows guests to visit login page', function () {
        /** @var \Illuminate\Testing\TestResponse $response */
        $response = $this->get('/login');
        $response->assertStatus(200);
    });
    test('Allow authenticated user to visit dashboard page', function () {
        $user = User::factory()->create();
        /** @var \Illuminate\Testing\TestResponse $response */
        $response = $this->actingAs($user)->get('/dashboard');
        $response->assertStatus(200);
    });
});
