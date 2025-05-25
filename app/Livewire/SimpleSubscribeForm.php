<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SubscribeForm extends Component
{
    public $subscriberEmail = '';
    public $loading = false;

    protected $rules = ['subscriberEmail' => 'required|email'];

    public function subscribe()
    {
        $this->validate();
        $this->loading = true;

        try {
            $resp = Http::post('/subscribe', ['sub_email' => $this->subscriberEmail]);
            $body = $resp->json();
            if ($body['status']) {
                $this->dispatchBrowserEvent('toast', ['type'=>'success','message'=>$body['message']]);
                $this->subscriberEmail = '';
            } else {
                $this->dispatchBrowserEvent('toast', ['type'=>'error','message'=>$body['message']]);
            }
        } catch (\Exception $e) {
            $this->dispatchBrowserEvent('toast', ['type'=>'error','message'=>'Erro ao assinar']);
        }

        $this->loading = false;
    }

    public function render()
    {
        return view('livewire.simple-subscribe-form');
    }
}
