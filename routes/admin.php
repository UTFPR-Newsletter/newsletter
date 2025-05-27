<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\AdminManagement;

Route::get('/dashboard', AdminDashboard::class)->name('admin.dashboard');
Route::get('/management', AdminManagement::class)->name('admin.management');
