<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/authors', fn() => Inertia::render('Authors'))->name('authors');

Route::post('/subscribe', [SubscriberController::class, 'store'])
    ->name('subscribers.store');
