<?php

namespace App\Livewire\Author;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\View\Components\Layouts\AuthorLayout;

#[Layout(AuthorLayout::class)]
class AuthorDashboard extends Component
{
    public $user;
    public $isMenuOpen = false;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function render()
    {
        return view('livewire.author.author-dashboard');
    }
} 