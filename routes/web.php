<?php

use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    // return Inertia::render('Welcome');
    return redirect()->route('dashboard');
})->name('home');


Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', function (Request $request) {
        return Inertia::render('Dashboard');
    })->name('dashboard');
    Route::resource('/tasks', TaskController::class);
});

Route::get('/hello', function (Request $request) {
    $name = $request->get('name', 'VILT');
    return response()->json(['message' => "Hello from $name!"]);
});
Route::post('/flash', function (Request $request) {
    $type =   $request->post('type', 'status');
    $message = $request->post('message', 'Default message');
    $request->session()->flash($type, $message);
    return redirect()->route('dashboard');
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
