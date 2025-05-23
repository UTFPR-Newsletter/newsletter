<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\HomeController;

//? Rotas
Route::get('/', [HomeController::class, 'index']);
Route::get('/login', fn() => Inertia::render('Login'))->name('login');
Route::get('/authors', fn() => Inertia::render('Authors'))->name('authors');

//? Code Endpoints 
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribers.store');
Route::post('subscriber/simple-login', [SubscriberController::class, 'sendSimpleLoginEmail'])->name('subscribers.simple-login');
