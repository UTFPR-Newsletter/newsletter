<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Subscriber;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;

#[Layout('components.layouts.app')]
class Login extends Component
{
    use Interactions;
    public $email = '';
    public $password = '';
    public $verificationCode = '';
    public $loading = false;
    public $error = '';
    public $success = '';
    public $showVerification = false;
    public $loginType = 'email'; // 'email' ou 'password'
    public $hasMagicLink = false;

    public function handleSubmit()
    {
        $this->loading = true;
        $this->error = '';
        $this->success = '';

        try {
            if ($this->loginType === 'email') {
                if (!$this->showVerification) {
                    $this->sendSimpleLogin();
                } else {
                    $this->validateCode();
                }
            } else {
                $this->loginWithPassword();
            }
        } catch (\Exception $e) {
            $this->error = $e->getMessage() ?: 'Ocorreu um erro ao tentar fazer login';
        } finally {
            $this->loading = false;
        }
    }

    public function sendSimpleLogin()
    {
        $this->validate([
            'email' => 'required|email'
        ], [
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'Digite um e-mail válido'
        ]);

        // Verifica se o usuário tem login mágico ativo
        $user = User::where('usr_email', $this->email)->first();
        if ($user && $user->usr_has_magic_link) {
            $this->hasMagicLink = true;
        }

        $subscriberController = new SubscriberController();
        $result = $subscriberController->sendSimpleLoginEmail($this->email);

        if ($result['status']) {
            $this->success = $result['message'];
            $this->showVerification = true;
            $this->toast()->success($result['message'])->send();
        } else {
            $this->error = $result['message'];
            $this->toast()->error($result['message'])->send();
        }
    }

    public function validateCode()
    {
        $this->validate([
            'email' => 'required|email',
            'verificationCode' => 'required|string|max:6'
        ], [
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'Digite um e-mail válido',
            'verificationCode.required' => 'O código é obrigatório',
            'verificationCode.max' => 'O código deve ter no máximo 6 caracteres'
        ]);

        $subscriberController = new SubscriberController();
        $result = $subscriberController->validateSimpleLogin($this->email, $this->verificationCode);

        if ($result['status']) {
            $this->success = $result['message'];
            $this->toast()->success($result['message'])->send();
            // Redirecionar após 1 segundo
            $this->dispatch('redirect-home');
        } else {
            $this->error = $result['message'];
            $this->toast()->error($result['message'])->send();
        }
    }

    public function loginWithPassword()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:3'
        ], [
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'Digite um e-mail válido',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter pelo menos 3 caracteres'
        ]);

        $subscriberController = new SubscriberController();
        $result = $subscriberController->validatePasswordLogin($this->email, $this->password);

        if ($result['status']) {
            $this->success = $result['message'];
            $this->toast()->success($result['message'])->send();
            // Redirecionar para a página inicial
            if($result['level'] == User::LEVEL_SUBSCRIBER) {
                return redirect()->intended('/');
            } else if($result['level'] == User::LEVEL_ADMIN) {
                return redirect()->intended('/admin/dashboard');
            } else if($result['level'] == User::LEVEL_AUTHOR) {
                return redirect()->intended('/author/dashboard');
            }
        } else {
            $this->error = $result['message'];
            $this->toast()->error($result['message'])->send();
        }
    }

    public function resetForm()
    {
        $this->email = '';
        $this->verificationCode = '';
        $this->showVerification = false;
        $this->error = '';
        $this->success = '';
    }

    public function switchToPassword()
    {
        $this->loginType = 'password';
        $this->resetForm();
    }

    public function switchToEmail()
    {
        $this->loginType = 'email';
        $this->resetForm();
    }

    public function mount()
    {
        // Se já estiver logado, redirecionar
        if (Auth::check()) {
            return redirect('/');
        }
    }

    public function render()
    {
        return view('livewire.login');
    }
}
