<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\dao\GenericCtrl;
use App\Http\Middleware\HandleInertiaRequests;

//? Rotas
Route::middleware([HandleInertiaRequests::class])->group(function(){
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/login', fn() => Inertia::render('Login'))->name('login');
    Route::get('/authors', fn() => Inertia::render('Authors'))->name('authors');
});

//? Code Endpoints
Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribers.store');
Route::post('subscriber/simple-login', [SubscriberController::class, 'sendSimpleLoginEmail'])->name('subscribers.simple-login');
Route::post('subscriber/validate-simple-login', [SubscriberController::class, 'validateSimpleLogin'])->name('subscribers.validate-simple-login');

//? Preview Email
Route::get('/preview-email', function () {
    $userCtrl = new GenericCtrl("User");
    $user = $userCtrl->getObject(1);
    $token = 'ABC123';
    return new \App\Mail\AccessCodeMail($user, $token);
});
