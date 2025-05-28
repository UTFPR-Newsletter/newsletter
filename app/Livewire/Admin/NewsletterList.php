<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Http\Controllers\dao\GenericCtrl;
use TallStackUi\Traits\Interactions;
use App\Models\Newsletter;

class NewsletterList extends Component
{
    use Interactions;

    public $newsletterModal = false;
    public $isEdit = false;

    // Form Properties
    public $newsletterForm = array(
        "id" => "",
        "title" => "",
        "body" => "",
        "icon" => "",
        "frequency" => "",
        "hour" => "",
        "estimate_date" => "",
        "status" => "",
    );

    // Search and Filter Properties
    public $search = '';
    public $newsletters = [];
    protected $newsletterCtrl;

    public function boot()
    {
        $this->newsletterCtrl = new GenericCtrl("Newsletter");
    }

    public function mount()
    {
        $this->loadNewsletters();
    }

    public function loadNewsletters()
    {
        $query = $this->newsletterCtrl->model::query();
        
        if ($this->search) {
            $query->where('new_title', 'like', '%' . $this->search . '%')
            ->orWhere('new_body', 'like', '%' . $this->search . '%');
        }
        
        $this->newsletters = $query->get();
    }

    public function showInsertModal() {
        $this->resetForm();
        $this->newsletterModal = true;
    }

    public function edit($id) {
        $this->isEdit = true;
        $newsletter = $this->newsletterCtrl->getObjectByField("new_id", $id);
        $this->newsletterForm["id"] = $id;
        $this->newsletterForm["title"] = $newsletter->new_title;
        $this->newsletterForm["body"] = $newsletter->new_body;
        $this->newsletterForm["icon"] = $newsletter->new_icon;
        $this->newsletterForm["frequency"] = $newsletter->new_frequency;
        $this->newsletterForm["hour"] = $newsletter->new_hour;
        $this->newsletterForm["estimate_date"] = $newsletter->new_estimate_date;
        $this->newsletterForm["status"] = $newsletter->new_status;
        $this->newsletterModal = true;
    }

    public function delete($id) {
        $this->dialog()
        ->question('Tem certeza que deseja excluir esta newsletter?')
        ->confirm(text: "Remover", method: "deleteNewsletter", params: $id)
        ->cancel(text: "Cancelar", method: "cancelled")
        ->send();
    }

    public function cancelled($message) {
        $this->toast()->error('Cancelado', $message)->send();
    }

    public function deleteNewsletter($id) {
        try {
            $this->newsletterCtrl->delete($id);
            $this->toast()->success('Newsletter excluída com sucesso!')->send();
            $this->loadNewsletters();
        } catch (\Exception $e) {
            $this->toast()->error('Ocorreu um erro ao excluir a newsletter. Tente novamente.')->send();
        }
    }

    public function resetForm()
    {
        $this->isEdit = false;
        $this->newsletterForm = array(
            "id" => "",
            "title" => "",
            "body" => "",
            "icon" => "",
            "frequency" => Newsletter::FREQUENCY_WEEKLY,
            "hour" => Newsletter::HOUR_14_00,
            "estimate_date" => now()->format('Y-m-d'),
            "status" => Newsletter::STATUS_ACTIVE,
        );
    }

    public function submitFormNewsletter()
    {
        try {
            $this->validate([
                'newsletterForm.title' => 'required|min:3|max:255',
                'newsletterForm.body' => 'required|min:10',
                'newsletterForm.frequency' => 'required|in:' . implode(',', array_keys(Newsletter::$frequencyOptions)),
                'newsletterForm.hour' => 'required|in:' . implode(',', array_keys(Newsletter::$hourOptions)),
                'newsletterForm.status' => 'required|in:' . implode(',', array_keys(Newsletter::$statusOptions)),
            ]);

            if($this->isEdit) {
                $this->newsletterCtrl->update($this->newsletterForm["id"], array(
                    "new_title" => $this->newsletterForm["title"],
                    "new_body" => $this->newsletterForm["body"],
                    "new_icon" => $this->newsletterForm["icon"],
                    "new_frequency" => $this->newsletterForm["frequency"],
                    "new_hour" => $this->newsletterForm["hour"],
                    "new_estimate_date" => $this->newsletterForm["estimate_date"],
                    "new_status" => $this->newsletterForm["status"],
                ));
            } else {
                $this->newsletterCtrl->save(array(
                    "new_title" => $this->newsletterForm["title"],
                    "new_body" => $this->newsletterForm["body"],
                    "new_icon" => $this->newsletterForm["icon"],
                    "new_frequency" => $this->newsletterForm["frequency"],
                    "new_hour" => $this->newsletterForm["hour"],
                    "new_estimate_date" => $this->newsletterForm["estimate_date"],
                    "new_status" => $this->newsletterForm["status"],
                ));
            }

            $this->newsletterModal = false;
            $this->resetForm();

            $this->toast()->success('Newsletter ' . ($this->isEdit ? 'atualizada' : 'criada') . ' com sucesso!')->send();
            
            $this->loadNewsletters();
        } catch (\Exception $e) {
            $this->toast()->error('Ocorreu um erro ao ' . ($this->isEdit ? 'atualizar' : 'criar') . ' a newsletter. Tente novamente.' . $e->getMessage())->send();
        }

        $this->newsletterModal = false;
    }

    public function updatedSearch()
    {
        $this->loadNewsletters();
    }

    public function render()
    {
        return view('livewire.admin.newsletter-list');
    }
} 