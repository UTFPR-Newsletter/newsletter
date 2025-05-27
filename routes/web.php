<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Http\Controllers\dao\GenericCtrl;
use App\Livewire\Home;
use App\Livewire\Login;
use App\Livewire\SubscriberProfile;
use App\Livewire\MagicLoginAuth;
use App\Livewire\Admin;

//? Rotas Gerais
Route::get('/login', Login::class)->name('login');

Route::post('/logout', function() {
    Auth::logout();
    return redirect('/');
})->name('logout');

//? Rotas de Subscriber
Route::get('/', Home::class);
Route::get('/profile', SubscriberProfile::class)->name('profile');
Route::get('/magic-login/{token}', MagicLoginAuth::class)->name('magic.login.auth');

//? Rotas de Admin
Route::get('/admin', Admin::class)->name('admin');

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

// Admin routes
Route::prefix('admin')->group(base_path('routes/admin.php'));