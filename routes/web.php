<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\dao\GenericCtrl;
use App\Http\Middleware\HandleInertiaRequests;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\SubscriberProfile;
use App\Livewire\MagicLoginAuth;

//? Rotas
Route::get('/', Home::class);
Route::get('/login', Login::class)->name('login');
Route::get('/profile', SubscriberProfile::class)->name('profile');
Route::get('/profile/magic-login-auth', MagicLoginAuth::class)->name('profile.magic-login-auth');

Route::post('/logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');

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
