<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Controllers\dao\GenericCtrl;
use TallStackUi\Traits\Interactions;

class AuthorList extends Component
{
    use Interactions;

    public $authorModal = false;
    public $isEdit = false;

    // Form Properties
    public $authorForm = array(
        "id" => "",
        "name" => "",
        "cpf" => "",
        "photo" => "",
        "body" => "",
    );

    // Search and Filter Properties
    public $search = '';
    public $authors = [];
    protected $authorCtrl;

    public function boot()
    {
        $this->authorCtrl = new GenericCtrl("Author");
    }

    public function mount()
    {
        $this->loadAuthors();
    }

    public function loadAuthors()
    {
        $query = $this->authorCtrl->model::query();
        
        if ($this->search) {
            $query->where('aut_name', 'like', '%' . $this->search . '%')
            ->orWhere('aut_cpf', 'like', '%' . $this->search . '%');
        }
        
        $this->authors = $query->get();
    }

    public function showInsertModal() {
        $this->resetForm();
        $this->authorModal = true;
    }

    public function edit($id) {
        $this->isEdit = true;
        $author = $this->authorCtrl->getObjectByField("aut_id", $id);
        $this->authorForm["id"] = $id;
        $this->authorForm["name"] = $author->aut_name;
        $this->authorForm["cpf"] = $author->aut_cpf;
        $this->authorForm["photo"] = $author->aut_photo;
        $this->authorForm["body"] = $author->aut_body;
        $this->authorModal = true;
    }

    public function delete($id) {
        $this->dialog()
        ->question('Tem certeza que deseja excluir este autor?')
        ->confirm(text: "Remover", method: "deleteAuthor", params: $id)
        ->cancel(text: "Cancelar", method: "cancelled")
        ->send();
    }

    public function cancelled($message) {
        $this->toast()->error('Cancelado', $message)->send();
    }

    public function deleteAuthor($id) {
        try {
            $this->authorCtrl->delete($id);
            $this->toast()->success('Autor excluído com sucesso!')->send();
            $this->loadAuthors();
        } catch (\Exception $e) {
            $this->toast()->error('Ocorreu um erro ao excluir o autor. Tente novamente.')->send();
        }
    }

    public function resetForm()
    {
        $this->isEdit = false;
        $this->authorForm = array(
            "id" => "",
            "name" => "",
            "cpf" => "",
            "photo" => "",
            "body" => "",
        );
    }

    public function submitFormAuthor()
    {
        try {
            $this->validate([
                'authorForm.name' => 'required|min:3|max:255',
                'authorForm.cpf' => 'required|min:11|max:14',
                'authorForm.body' => 'required|min:10|max:1000'
            ]);

            if($this->isEdit) {
                $this->authorCtrl->update($this->authorForm["id"], array(
                    "aut_name" => $this->authorForm["name"],
                    "aut_cpf" => $this->authorForm["cpf"],
                    "aut_photo" => $this->authorForm["photo"],
                    "aut_body" => $this->authorForm["body"],
                ));
            } else {
                $this->authorCtrl->save(array(
                    "aut_name" => $this->authorForm["name"],
                    "aut_cpf" => $this->authorForm["cpf"],
                    "aut_photo" => $this->authorForm["photo"],
                    "aut_body" => $this->authorForm["body"],
                ));
            }

            $this->authorModal = false;
            $this->resetForm();

            $this->toast()->success('Autor ' . ($this->isEdit ? 'atualizado' : 'criado') . ' com sucesso!')->send();
            
            $this->loadAuthors();
        } catch (\Exception $e) {
            $this->toast()->error('Ocorreu um erro ao ' . ($this->isEdit ? 'atualizar' : 'criar') . ' o autor. Tente novamente.' . $e->getMessage())->send();
        }

        $this->authorModal = false;
    }

    public function updatedSearch()
    {
        $this->loadAuthors();
    }

    public function render()
    {
        return view('livewire.admin.author-list');
    }
} 