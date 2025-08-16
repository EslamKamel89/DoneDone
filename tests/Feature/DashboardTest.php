<?php

use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

test('guests are redirected to the login page', function () {
    $response = $this->get('/dashboard');
    $response->assertRedirect('/login');
});

test('authenticated users can visit the dashboard', function () {
    // $user = User::factory()->create();
    $this->actingAs($this->user);

    /** @var Illuminate\Testing\TestResponse $response */
    $response = $this->get('/dashboard');
    $response->assertStatus(200);
});
test('Dashboard vue component and it is inertia response', function () {
    $this->actingAs($this->user);
    /** @var Illuminate\Testing\TestResponse $response */
    $response = $this->get('/dashboard');
    $response->assertInertia(
        fn(\Inertia\Testing\AssertableInertia $page) =>
        $page->component('Dashboard')
            ->has('auth.user')
            ->where('auth.user.name', $this->user->name)
            ->where('auth.user.email', $this->user->email)
            ->hasAll(['errors', 'name', 'ziggy'])
    );
});
