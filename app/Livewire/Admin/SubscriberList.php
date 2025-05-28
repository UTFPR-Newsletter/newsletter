<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Controllers\dao\GenericCtrl;
use TallStackUi\Traits\Interactions;

class SubscriberList extends Component
{
    use Interactions;

    public $subscriberModal = false;
    public $isEdit = false;

    // Form Properties
    public $subscriberForm = array(
        "id" => "",
        "name" => "",
        "email" => "",
    );

    // Search and Filter Properties
    public $search = '';
    public $subscribers = [];
    protected $subscriberCtrl;

    public function boot()
    {
        $this->subscriberCtrl = new GenericCtrl("Subscriber");
    }

    public function mount()
    {
        $this->loadSubscribers();
    }

    public function loadSubscribers()
    {
        $query = $this->subscriberCtrl->model::query();
        
        if ($this->search) {
            $query->where('sub_name', 'like', '%' . $this->search . '%')
            ->orWhere('sub_email', 'like', '%' . $this->search . '%');
        }
        
        $this->subscribers = $query->get();
    }

    public function showInsertModal() {
        $this->resetForm();
        $this->subscriberModal = true;
    }

    public function edit($id) {
        $this->isEdit = true;
        $subscriber = $this->subscriberCtrl->getObjectByField("sub_id", $id);
        $this->subscriberForm["id"] = $id;
        $this->subscriberForm["name"] = $subscriber->sub_name;
        $this->subscriberForm["email"] = $subscriber->sub_email;
        $this->subscriberModal = true;
    }

    public function delete($id) {
        $this->dialog()
        ->question('Tem certeza que deseja excluir este assinante?')
        ->confirm(text: "Remover", method: "deleteSubscriber", params: $id)
        ->cancel(text: "Cancelar", method: "cancelled")
        ->send();
    }

    public function cancelled($message) {
        $this->toast()->error('Cancelado', $message)->send();
    }

    public function deleteSubscriber($id) {
        try {
            $this->subscriberCtrl->delete($id);
            $this->toast()->success('Assinante excluído com sucesso!')->send();
            $this->loadSubscribers();
        } catch (\Exception $e) {
            $this->toast()->error('Ocorreu um erro ao excluir o assinante. Tente novamente.')->send();
        }
    }

    public function resetForm()
    {
        $this->isEdit = false;
        $this->subscriberForm = array(
            "id" => "",
            "name" => "",
            "email" => "",
        );
    }

    public function submitFormSubscriber()
    {
        try {
            $this->validate([
                'subscriberForm.name' => 'required|min:3|max:255',
                'subscriberForm.email' => 'required|email|max:255'
            ]);

            if($this->isEdit) {
                $this->subscriberCtrl->update($this->subscriberForm["id"], array(
                    "sub_name" => $this->subscriberForm["name"],
                    "sub_email" => $this->subscriberForm["email"],
                ));
            } else {
                $this->subscriberCtrl->save(array(
                    "sub_name" => $this->subscriberForm["name"],
                    "sub_email" => $this->subscriberForm["email"],
                ));
            }

            $this->subscriberModal = false;
            $this->resetForm();

            $this->toast()->success('Assinante ' . ($this->isEdit ? 'atualizado' : 'criado') . ' com sucesso!')->send();
            
            $this->loadSubscribers();
        } catch (\Exception $e) {
            $this->toast()->error('Ocorreu um erro ao ' . ($this->isEdit ? 'atualizar' : 'criar') . ' o assinante. Tente novamente.' . $e->getMessage())->send();
        }

        $this->subscriberModal = false;
    }

    public function updatedSearch()
    {
        $this->loadSubscribers();
    }

    public function render()
    {
        return view('livewire.admin.subscriber-list');
    }
} 