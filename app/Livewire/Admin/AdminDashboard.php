<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\View\Components\Layouts\AdminLayout;

#[Layout(AdminLayout::class)]
class AdminDashboard extends Component
{
    public $user;
    public $isMenuOpen = false;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
} 