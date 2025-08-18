<?php

use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Util\Test;
use Tests\TestCase;

use function Pest\Laravel\assertModelExists;

uses(RefreshDatabase::class);
test('has a valid factory that creates a task in the database', function () {
    $task = Task::factory()->create();
    assertModelExists($task);
    expect($task->title)->not()->toBeEmpty();
    expect($task->status)->toBeIn(['pending', 'completed']);
});
test('can be created with pending status via factory state', function () {
    $task = Task::factory()->pending()->create();
    assertModelExists($task);
    expect($task->title)->not()->toBeEmpty();
    expect($task->status)->toBe('pending');
});
test('can be created with completed status via factory state', function () {
    $task = Task::factory()->completed()->create();
    assertModelExists($task);
    expect($task->title)->not()->toBeEmpty();
    expect($task->status)->toBe('completed');
});
test('task belongs to a user', function () {
    $task = Task::factory()->create();
    expect($task->user)->toBeInstanceOf(User::class);
});
