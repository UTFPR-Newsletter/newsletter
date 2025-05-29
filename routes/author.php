<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Author\AuthorDashboard;
use App\Livewire\Author\AuthorProfile;

Route::get('/dashboard', AuthorDashboard::class)->name('author.dashboard');
Route::get('/profile', AuthorProfile::class)->name('author.profile');
