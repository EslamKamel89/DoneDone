<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    // return Inertia::render('Welcome');
    return redirect()->route('dashboard');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/hello', function (Request $request) {
    $name = $request->get('name', 'VILT');
    return response()->json(['message' => "Hello from $name!"]);
});


require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';
