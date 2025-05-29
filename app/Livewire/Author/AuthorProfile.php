<?php

namespace App\Livewire\Author;

use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\dao\GenericCtrl;
use App\Http\Controllers\Utils\TripleDES;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use App\View\Components\Layouts\AuthorLayout;

#[Layout(AuthorLayout::class)]
class AuthorProfile extends Component
{
    use Interactions;
    use WithFileUploads;

    public $activeTab = 'magic-login';
    public $user;
    public $hasPassword = false;

    public $editProfileForm = array(
        'name' => '',
        'cpf' => '',
        'photo' => null,
        'body' => '',
        'email' => '',
    );

    public $passwordForm = array(
        'current_password' => '',
        'new_password' => '',
        'new_password_confirmation' => '',
    );

    public function mount()
    {
        $authorCtrl = new GenericCtrl("Author");

        $this->user = Auth::user();
        $author = $authorCtrl->getObject($this->user->represented_agent_id);

        if (!$this->user) {
            return redirect('/');
        }

        $this->editProfileForm['name'] = $author->aut_name;
        $this->editProfileForm['cpf'] = $author->aut_cpf;
        $this->editProfileForm['body'] = $author->aut_body;
        $this->editProfileForm['email'] = $this->user->usr_email;
        $this->hasPassword = !is_null($this->user->usr_password);
    }

    public function updateProfile() 
    {
        $this->toast()->info('Aguarde um momento...')->send();
        $userCtrl = new GenericCtrl("User");
        $authorCtrl = new GenericCtrl("Author");

        // Atualiza o autor
        $updateData = [
            'aut_name' => $this->editProfileForm['name'],
            'aut_cpf' => $this->editProfileForm['cpf'],
            'aut_body' => $this->editProfileForm['body'],
        ];

        // Se tiver nova foto, faz o upload
        if ($this->editProfileForm['photo']) {
            // Define caminho relativo dentro do disco `public`
            $relativePath = "images/authors/{$this->user->represented_agent_id}";

            // Garante que o diretório exista
            Storage::disk('public')->makeDirectory($relativePath);

            // Gera nome único
            $originalName = pathinfo(
                $this->editProfileForm['photo']->getClientOriginalName(),
                PATHINFO_FILENAME
            );
            $extension = $this->editProfileForm['photo']->getClientOriginalExtension();
            $photoName = $originalName . '_' . time() . '.' . $extension;

            // Salva no disco `public`
            $this->editProfileForm['photo']->storeAs($relativePath, $photoName, 'public');

            // Adiciona a foto aos dados de atualização
            $updateData['aut_photo'] = $photoName;
        }

        $authorCtrl->update($this->user->represented_agent_id, $updateData);

        // Atualiza o email do usuário se necessário
        $userCtrl->update($this->user->usr_id, [
            'usr_email' => $this->editProfileForm['email'],
        ]);

        $this->toast()->success('Informações atualizadas com sucesso')->flash()->send();
        $this->redirectRoute('author.profile');
    }

    public function updatePassword() 
    {
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

        $userCtrl->update($this->user->usr_id, [
            'usr_password' => $encryptedPassword,
        ]);

        // Limpa o formulário
        $this->passwordForm = [
            'current_password' => '',
            'new_password' => '',
            'new_password_confirmation' => '',
        ];

        $this->hasPassword = true;
        $this->toast()->success('Senha atualizada com sucesso')->flash()->send();
        $this->redirectRoute('author.profile');
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
            $userCtrl->update($this->user->usr_id, [
                'usr_has_magic_link' => false,
                'usr_magic_link' => null,
                'usr_magic_link_expires_at' => null,
            ]);

            $this->toast()->success('Link mágico desativado')->flash()->send();
        } else {
            $userCtrl->update($this->user->usr_id, [
                'usr_has_magic_link' => true,
                'usr_magic_link' => "",
                'usr_magic_link_expires_at' => now()->addDays(2),
            ]);

            $this->toast()->success('Link mágico ativado')->flash()->send();
        }

        return redirect()->route('author.profile');
    }

    public function render()
    {
        return view('livewire.author.author-profile');
    }
} 