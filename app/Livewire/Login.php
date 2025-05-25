<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Subscriber;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Http\Request;

#[Layout('components.layouts.app')]
class Login extends Component
{
    public $email = '';
    public $password = '';
    public $verificationCode = '';
    public $loading = false;
    public $error = '';
    public $success = '';
    public $showVerification = false;
    public $loginType = 'email'; // 'email' ou 'password'

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

        // Criar um request fake para usar o método do controller
        $request = new Request();
        $request->merge(['sub_email' => $this->email]);

        $subscriberController = new SubscriberController();
        $response = $subscriberController->sendSimpleLoginEmail($request);
        $data = json_decode($response->getContent(), true);

        if ($data['status']) {
            $this->success = $data['message'];
            $this->showVerification = true;
        } else {
            $this->error = $data['message'];
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

        // Criar um request fake para usar o método do controller
        $request = new Request();
        $request->merge([
            'sub_email' => $this->email,
            'token' => $this->verificationCode
        ]);

        $subscriberController = new SubscriberController();
        $response = $subscriberController->validateSimpleLogin($request);
        $data = json_decode($response->getContent(), true);

        if ($data['status']) {
            $this->success = $data['message'];
            // Redirecionar após 1 segundo
            $this->dispatch('redirect-home');
        } else {
            $this->error = $data['message'];
        }
    }

    public function loginWithPassword()
    {
        $this->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'O e-mail é obrigatório',
            'email.email' => 'Digite um e-mail válido',
            'password.required' => 'A senha é obrigatória',
            'password.min' => 'A senha deve ter pelo menos 6 caracteres'
        ]);

        // Buscar usuário pelo email
        $user = User::where('usr_email', $this->email)->first();

        if ($user && Hash::check($this->password, $user->usr_senha) && $user->usr_active) {
            // Login bem-sucedido
            Auth::login($user);
            
            // Redirecionar baseado no nível do usuário
            switch ($user->usr_level) {
                case User::LEVEL_ADMIN:
                    return redirect()->intended('/admin');
                case User::LEVEL_AUTHOR:
                    return redirect()->intended('/author');
                case User::LEVEL_SUBSCRIBER:
                default:
                    return redirect()->intended('/');
            }
        } else {
            $this->error = 'Credenciais inválidas ou conta inativa';
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
