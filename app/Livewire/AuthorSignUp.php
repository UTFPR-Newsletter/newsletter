<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;
use App\Http\Controllers\dao\GenericCtrl;
use App\Http\Controllers\Utils\TripleDES;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
#[Layout('components.layouts.app')]
class AuthorSignUp extends Component
{
    use Interactions;
    use WithFileUploads;

    public $authorForm = array(
        'name' => '',
        'cpf' => '',
        'photo' => null,
        'body' => '',
        'email' => '',
    );

    protected $rules = [
        'authorForm.name' => 'required|min:3',
        'authorForm.cpf' => 'required|size:11',
        'authorForm.email' => 'required|email|unique:users,usr_email',
        'authorForm.photo' => 'nullable|image|max:2048',
        'authorForm.body' => 'nullable',
    ];

    protected $messages = [
        'authorForm.name.required' => 'O nome é obrigatório',
        'authorForm.name.min' => 'O nome deve ter no mínimo 3 caracteres',
        'authorForm.cpf.required' => 'O CPF é obrigatório',
        'authorForm.cpf.size' => 'O CPF deve ter 11 dígitos',
        'authorForm.email.required' => 'O email é obrigatório',
        'authorForm.email.email' => 'Digite um email válido',
        'authorForm.email.unique' => 'Este email já está em uso',
        'authorForm.photo.image' => 'O arquivo deve ser uma imagem',
        'authorForm.photo.max' => 'A imagem deve ter no máximo 2MB',
    ];

    public function handleSubmit()
    {
        try {
            $this->validate();
        
            $this->toast()->info('Aguarde um momento...')->send();

            $userCtrl = new GenericCtrl("User");
            $authorCtrl = new GenericCtrl("Author");
            
            // Primeiro cria o usuário
            $user = $userCtrl->save(array(
                'usr_email' => $this->authorForm['email'],
                'usr_level' => User::LEVEL_AUTHOR,
                'usr_active' => true,
                'usr_has_magic_link' => true,
                'usr_magic_link' => null,
                'usr_magic_link_expires_at' => now()->addDays(2),
            ));

            // Depois cria o autor (inicialmente sem foto)
            $author = $authorCtrl->save(array(
                'aut_name' => $this->authorForm['name'],
                'aut_cpf' => $this->authorForm['cpf'],
                'aut_photo' => null,
                'aut_body' => $this->authorForm['body'],
            ));

            // Se tiver foto, faz o upload
            if ($this->authorForm['photo']) {
                // Define caminho relativo dentro do disco `public`
                $relativePath = "images/authors/{$author->aut_id}";

                // Garante que o diretório exista
                Storage::disk('public')->makeDirectory($relativePath);

                // Gera nome único
                $originalName = pathinfo(
                    $this->authorForm['photo']->getClientOriginalName(),
                    PATHINFO_FILENAME
                );
                $extension = $this->authorForm['photo']->getClientOriginalExtension();
                $photoName = $originalName . '_' . time() . '.' . $extension;

                // Salva no disco `public` (storage/app/public/...)
                $this->authorForm['photo']
                        ->storeAs($relativePath, $photoName, 'public');

                // Atualiza o autor com o nome da foto
                $authorCtrl->update($author->aut_id, array(
                    'aut_photo' => $photoName,
                ));
            }

            // Atualiza o usuário com o ID do autor
            $userCtrl->update($user->usr_id, array(
                'represented_agent_id' => $author->aut_id,
            ));

            Auth::login($user);

            $this->toast()->success('Cadastro realizado com sucesso! Redirecionando para o painel...')->flash()->send();
            return redirect()->route('author.dashboard');
        } catch (\Throwable $th) {
            $this->toast()->error('Erro ao cadastrar autor: ' . $th->getMessage())->send();
        }
    }

    public function render()
    {
        return view('livewire.author-sign-up');
    }
}
