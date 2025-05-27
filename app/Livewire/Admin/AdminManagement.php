<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Auth;
use App\View\Components\Layouts\AdminLayout;

#[Layout(AdminLayout::class)]
class AdminManagement extends Component
{
    public $user;
    public $isMenuOpen = false;

    public $categoryModal = false;
    public $topicModal = false;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function showCorrectInsertModal($type) {
        if($type == 'categories') {
            $this->categoryModal = true;
        } else if($type == 'topics') {
            $this->topicModal = true;
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.admin.admin-management');
    }
} 