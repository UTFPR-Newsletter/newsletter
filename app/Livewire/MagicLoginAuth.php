<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Http\Controllers\Utils\TripleDES;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use TallStackUi\Traits\Interactions;

#[Layout('components.layouts.app')]
class MagicLoginAuth extends Component
{
    use Interactions;

    public $token;
    public $error = null;

    public function mount($token = null)
    {
        $this->token = $token;

        if ($this->token) {
            $this->authenticateWithToken();
        }
    }

    public function authenticateWithToken()
    {
        try {
            // Descriptografa o token
            $tripleDES = new TripleDES();
            $decrypted = $tripleDES->decrypt($this->token);
            $data = json_decode($decrypted, true);

            if (!$data || !isset($data['user_id']) || !isset($data['created_at'])) {
                $this->error = "Token inválido";
                return;
            }

            // Verifica se o token não expirou (24 horas)
            $createdAt = \Carbon\Carbon::parse($data['created_at']);
            if ($createdAt->diffInHours(now()) > 24) {
                $this->error = "Token expirado";
                return;
            }

            // Busca o usuário
            $user = User::find($data['user_id']);
            if (!$user || !$user->usr_has_magic_link) {
                $this->error = "Usuário não encontrado ou login mágico desativado";
                return;
            }

            // Faz o login
            Auth::login($user);
            
            // Redireciona para a home
            $this->toast()->success('Login realizado com sucesso!')->send();
            return redirect()->route('home');

        } catch (\Exception $e) {
            $this->error = "Erro ao processar o token";
        }
    }

    public function render()
    {
        return view('livewire.magic-login-auth');
    }
}
