<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);


describe('Hello Api', function () {
    dataset('greetingNames', [
        'VILT',
        'Laravel',
        'Pest',
        'Vue',
    ]);
    test('returns hello message', function (string $name) {
        /** @var Illuminate\Testing\TestResponse $response */
        $response = $this->get("/hello?name=$name");
        // dd($response);
        expect($response->status())->toBe(200)
            ->and($response->json('message'))->toBe("Hello from $name!");
    })->with('greetingNames');
    test('returns correct content type', function () {
        /** @var Illuminate\Testing\TestResponse $response */
        $response = $this->get('/hello');
        expect($response->headers->get('content-type'))->toContain('application/json');
    });
    test('method post not allowed', function () {
        /** @var Illuminate\Testing\TestResponse $response */
        $response = $this->post('/hello');
        expect($response->status())->toBe(405);
    });
});
