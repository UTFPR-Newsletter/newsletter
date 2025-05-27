<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\dao\GenericCtrl;
use App\Http\Controllers\Utils\TripleDES;

#[Layout('components.layouts.app')]
class SubscriberProfile extends Component
{
    use Interactions;

    public $activeTab = 'magic-login';
    public $user;
    public $hasPassword = false;

    public $editProfileForm = array(
        'usr_name' => '',
        'usr_email' => '',
    );

    public $passwordForm = array(
        'current_password' => '',
        'new_password' => '',
        'new_password_confirmation' => '',
    );

    public function mount()
    {
        $subscriberCtrl = new GenericCtrl("Subscriber");

        $this->user = Auth::user();
        $subscriber = $subscriberCtrl->getObject($this->user->represented_agent_id);

        if (!$this->user) {
            return redirect('/');
        }

        $this->editProfileForm['usr_name'] = $subscriber->sub_name;
        $this->editProfileForm['usr_email'] = $this->user->usr_email;
        $this->hasPassword = !is_null($this->user->usr_password);
    }

    public function updateProfile() {
        $this->toast()->info('Aguarde um momento...')->send();
        $userCtrl = new GenericCtrl("User");
        $subscriberCtrl = new GenericCtrl("Subscriber");

        $subscriberCtrl->update($this->user->represented_agent_id, array(
            'sub_name' => $this->editProfileForm['usr_name'],
            'sub_email' => $this->editProfileForm['usr_email'],
        ));

        $userCtrl->update($this->user->usr_id, array(
            'usr_email' => $this->editProfileForm['usr_email'],
        ));

        $this->toast()->success('Informações atualizadas com sucesso')->flash()->send();
        $this->redirectRoute('profile');
    }

    public function updatePassword() {
        // Validação dos campos
        if ($this->passwordForm['new_password'] !== $this->passwordForm['new_password_confirmation']) {
            $this->toast()->error('As senhas não conferem')->send();
            return;
        }

        $tripleDES = new TripleDES();

        // Se já existe uma senha, valida a senha atual
        if ($this->hasPassword) {
            // Descriptografa a senha do banco para comparar
            $currentDbPassword = $tripleDES->decrypt($this->user->usr_password);
            
            if ($currentDbPassword !== $this->passwordForm['current_password']) {
                $this->toast()->error('Senha atual incorreta')->send();
                return;
            }
        }

        $this->toast()->info('Aguarde um momento...')->send();
        $userCtrl = new GenericCtrl("User");

        // Criptografa a nova senha antes de salvar
        $encryptedPassword = $tripleDES->encrypt($this->passwordForm['new_password']);

        $userCtrl->update($this->user->usr_id, array(
            'usr_password' => $encryptedPassword,
        ));

        // Limpa o formulário
        $this->passwordForm = array(
            'current_password' => '',
            'new_password' => '',
            'new_password_confirmation' => '',
        );

        $this->hasPassword = true;
        $this->toast()->success('Senha atualizada com sucesso')->flash()->send();
        $this->redirectRoute('profile');
    }

    public function logout()
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        
        $this->toast()->success('Logout realizado com sucesso!')->send();
        
        return redirect('/');
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
