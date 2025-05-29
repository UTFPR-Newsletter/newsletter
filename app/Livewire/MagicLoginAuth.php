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
    public $isProcessing = true;
    public $isSuccess = false;

    public function mount($token = null)
    {
        $this->token = $token;

        if ($this->token) {
            sleep(5);
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
                $this->isProcessing = false;
                return;
            }

            // Verifica se o token não expirou (48 horas)
            $createdAt = \Carbon\Carbon::parse($data['created_at']);
            if ($createdAt->diffInHours(now()) > 48) {
                $this->error = "Token expirado";
                $this->isProcessing = false;
                return;
            }

            // Busca o usuário
            $user = User::find($data['user_id']);
            if (!$user || !$user->usr_has_magic_link) {
                $this->error = "Usuário não encontrado ou login mágico desativado";
                $this->isProcessing = false;
                return;
            }
            
            // Faz o login
            Auth::login($user);
            
            // Marca como sucesso e aguarda mais 1 segundo antes de redirecionar
            $this->isProcessing = false;
            $this->isSuccess = true;
            
            // Envia o toast e redireciona após 1 segundo
            $this->toast()->success('Login realizado com sucesso!')->flash()->send();
            sleep(5);
            
            if($user->usr_level == User::LEVEL_AUTHOR) {
                return redirect()->route('author.dashboard');
            } else {
                return redirect('/');
            }

        } catch (\Exception $e) {
            $this->error = "Erro ao processar o token";
            $this->isProcessing = false;
        }
    }

    public function render()
    {
        return view('livewire.magic-login-auth');
    }
}
