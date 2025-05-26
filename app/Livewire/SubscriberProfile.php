<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\dao\GenericCtrl;

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
        $this->toast()->info('Aguarde um momento...')->send();
        $userCtrl = new GenericCtrl("User");

        if($this->user->usr_has_magic_link) {
            $userCtrl->update($this->user->usr_id, array(
                'usr_has_magic_link' => false,
                'usr_magic_link' => null,
                'usr_magic_link_expires_at' => null,
            ));

            $this->toast()->success('Link mágico desativado')->flash()->send();
        } else {
            $userCtrl->update($this->user->usr_id, array(
                'usr_has_magic_link' => true,
                'usr_magic_link' => "",
                'usr_magic_link_expires_at' => now()->addMinutes(10),
            ));

            $this->toast()->success('Link mágico ativado')->flash()->send();
        }

        return redirect()->route('profile');
    }

    public function render()
    {
        return view('livewire.subscriber-profile');
    }
}
