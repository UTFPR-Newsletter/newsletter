<?php

namespace App\View\Components\Layouts;

use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthorLayout extends Component
{
    public $user;

    public function __construct()
    {
        $this->user = Auth::user();

        if (!$this->user || $this->user->usr_level !== User::LEVEL_AUTHOR) {
            Auth::logout();
            redirect()->route('login')->send();
        }
    }

    public function render(): View
    {
        return view('components.layouts.author-layout', [
            'user' => $this->user
        ]);
    }
} 