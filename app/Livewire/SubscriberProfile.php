<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class SubscriberProfile extends Component
{
    use Interactions;

    public $activeTab = 'magic-login';
    public $user;

    public function mount()
    {
        $this->user = Auth::user();
        if (!$this->user) {
            return redirect('/');
        }
    }

    public function sendMagicLogin()
    {
        $subscriberController = new \App\Http\Controllers\SubscriberController();
        $result = $subscriberController->sendSimpleLoginEmailForLivewire($this->user->usr_email);

        if ($result['status']) {
            $this->toast()->success($result['message'])->send();
        } else {
            $this->toast()->error($result['message'])->send();
        }
    }

    public function render()
    {
        return view('livewire.subscriber-profile');
    }
}
