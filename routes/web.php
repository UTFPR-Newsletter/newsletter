<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SubscriberController;

Route::get('/', function () {
    return Inertia::render('Home');
});

Route::get('/authors', function () {
    return Inertia::render('Authors');
});

Route::post('/subscribe', [SubscriberController::class, 'store'])
    ->name('subscribers.store');
