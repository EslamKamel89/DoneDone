<?php
// use Illuminate\Foundation\Testing\RefreshDatabase;
// uses(RefreshDatabase::class);

use App\Models\User;

beforeeach(function () {
    $this->user = User::factory()->create();
});
test('Redirect after flashing message', function () {
    /** @var Illuminate\Testing\TestResponse $response */
    $response = $this->actingAs($this->user)->post('/flash');

    $response->assertRedirect('/dashboard');
});
// test('Sets a flash message in the session', function () {
//     /** @var Illuminate\Testing\TestResponse $response */
//     $response = $this->actingAs($this->user)->post('/flash');

//     $response->assertSessionHas('status', 'Operation completed successfully');
// });
test('Flash message content is passed as prop through inertia', function ($type, $message) {
    $this->actingAs($this->user)->post('/flash', [
        'type' => $type,
        'message' => $message,
    ]);
    /** @var Illuminate\Testing\TestResponse $response */
    $response = $this->actingAs($this->user)->get('/dashboard');
    $response->assertInertia(function (\Inertia\Testing\AssertableInertia $page) use (
        $type,
        $message
    ) {
        $page->component('Dashboard')
            ->has("flash.$type")
            ->where("flash.$type", $message);
    });
})->with([
    ['status', 'Task saved!'],
    ['error', 'Something went wrong!'],
    ['warning', 'Please review your input.'],
]);
