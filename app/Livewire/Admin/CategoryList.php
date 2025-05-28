<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Controllers\dao\GenericCtrl;
use TallStackUi\Traits\Interactions;

class CategoryList extends Component
{
    use Interactions;

    public $categoryModal = false;
    public $isEdit = false;

    // Form Properties
    public $categoryForm = array(
        "id" => "",
        "name" => "",
        "description" => "",
    );

    // Search and Filter Properties
    public $search = '';
    public $categories = [];
    protected $categoryCtrl;

    public function boot()
    {
        $this->categoryCtrl = new GenericCtrl("Category");
    }

    public function mount()
    {
        $this->loadCategories();
    }

    public function loadCategories()
    {
        $query = $this->categoryCtrl->model::query();
        
        if ($this->search) {
            $query->where('cat_name', 'like', '%' . $this->search . '%')
                  ->orWhere('cat_description', 'like', '%' . $this->search . '%');
        }
        
        $this->categories = $query->get();
    }

    public function showInsertModal() {
        $this->resetForm();
        $this->categoryModal = true;
    }

    public function edit($id) {
        $this->isEdit = true;
        $this->categoryForm["id"] = $id;
        $this->categoryForm["name"] = $this->categoryCtrl->getObjectByField("cat_id", $id)->cat_name;
        $this->categoryForm["description"] = $this->categoryCtrl->getObjectByField("cat_id", $id)->cat_description;
        $this->categoryModal = true;
    }

    public function delete($id) {
        $this->dialog()
        ->question('Tem certeza que deseja excluir esta categoria?')
        ->confirm(text: "Remover", method: "deleteCategory", params: $id)
        ->cancel(text: "Cancelar", method: "cancelled")
        ->send();
    }

    public function cancelled($message) {
        $this->toast()->error('Cancelado', $message)->send();
    }

    public function deleteCategory($id) {
        try {
            $this->categoryCtrl->delete($id);
            $this->toast()->success('Categoria excluída com sucesso!')->send();
            $this->loadCategories();
        } catch (\Exception $e) {
            $this->toast()->error('Ocorreu um erro ao excluir a categoria. Tente novamente.')->send();
        }
    }

    public function resetForm()
    {
        $this->isEdit = false;
        $this->categoryForm = array(
            "id" => "",
            "name" => "",
            "description" => "",
        );
    }

    public function submitFormCategory()
    {
        try {
            $this->validate([
                'categoryForm.name' => 'required|min:3|max:255',
                'categoryForm.description' => 'required|min:10|max:1000'
            ]);

            if($this->isEdit) {
                $this->categoryCtrl->update($this->categoryForm["id"], array(
                    "cat_name" => $this->categoryForm["name"],
                    "cat_description" => $this->categoryForm["description"],
                ));
            } else {
                $this->categoryCtrl->save(array(
                    "cat_name" => $this->categoryForm["name"],
                    "cat_description" => $this->categoryForm["description"],
                ));
            }

            $this->categoryModal = false;
            $this->resetForm();

            $this->toast()->success('Categoria ' . ($this->isEdit ? 'atualizada' : 'criada') . ' com sucesso!')->send();
            
            $this->loadCategories();
        } catch (\Exception $e) {
            $this->toast()->error('Ocorreu um erro ao ' . ($this->isEdit ? 'atualizar' : 'criar') . ' a categoria. Tente novamente.' . $e->getMessage())->send();
        }

        $this->categoryModal = false;
    }

    public function updatedSearch()
    {
        $this->loadCategories();
    }

    public function render()
    {
        return view('livewire.admin.category-list');
    }
} 