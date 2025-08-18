<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller {
    public function index() {
        return inertia('Tasks/Index', [
            'tasks' => auth()->user()->tasks()->latest()->get(),
        ]);
    }

    public function create() {
        return inertia('Tasks/Create');
    }

    public function store(Request $request) {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string'
        ]);
        $validatd['status'] = 'pending';
        $validated['user_id'] = auth()->id();
        $task = Task::create($validated);
        return redirect()->route('tasks.index')->with('status', 'Task Created Successfully');
    }

    public function show(Task $task) {
    }

    public function edit(Task $task) {
    }

    public function update(Request $request, Task $task) {
    }

    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('tasks.index')->with('status', 'Task Deleted Successfully');
    }
}
