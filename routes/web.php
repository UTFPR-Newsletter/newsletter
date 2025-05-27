<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\dao\GenericCtrl;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\SubscriberProfile;
use App\Livewire\MagicLoginAuth;

//? Rotas
Route::get('/', Home::class);
Route::get('/login', Login::class)->name('login');
Route::get('/profile', SubscriberProfile::class)->name('profile');
Route::get('/magic-login/{token}', MagicLoginAuth::class)->name('magic.login.auth');

Route::post('/logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');


//? Preview Email
Route::get('/preview-email', function () {
    $userCtrl = new GenericCtrl("User");
    $user = $userCtrl->getObject(1);
    $token = 'ABC123';
    return new \App\Mail\AccessCodeMail($user, $token);
});

//? Preview Email
Route::get('/preview-email-magic', function () {
    $userCtrl = new GenericCtrl("User");
    $user = $userCtrl->getObject(1);
    $token = 'teste';
    return new \App\Mail\MagicLinkMail($user, $token);
});