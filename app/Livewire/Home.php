<?php

namespace App\Livewire;

use App\Models\Author;
use App\Models\Newsletter;
use App\Models\Subscriber;
use App\Http\Controllers\SubscriberController;
use Livewire\Component;
use Livewire\Attributes\Layout;
use TallStackUi\Traits\Interactions;
use Illuminate\Support\Facades\Auth;

#[Layout('components.layouts.app')]
class Home extends Component
{
    use Interactions;

    public $subscriberEmail = '';
    public $searchQuery = '';
    public $loading = false;

    public function subscribe()
    {
        $this->validate([
            'subscriberEmail' => 'required|email'
        ], [
            'subscriberEmail.required' => 'Digite um e-mail antes de assinar',
            'subscriberEmail.email' => 'Digite um e-mail válido'
        ]);

        $this->loading = true;

        $subscriberController = new SubscriberController();
        $result = $subscriberController->store($this->subscriberEmail);

        if ($result['status']) {
            $this->toast()->success($result['message'])->send();
            $this->subscriberEmail = '';
        } else {
            $this->toast()->error($result['message'])->send();
        }

        $this->loading = false;
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
        return redirect()->route('profile');
    }

    public function editProfile()
    {
        if (!Auth::user()) {
            $this->toast()->error('Usuário não encontrado!')->send();
            return;
        }

        return redirect()->route('profile');
    }

    public function render()
    {
        // Get all authors with their topics
        $authors = Author::with('topics')->get()->map(function($author) {
            // Convert the topics to badge format
            $badges = $author->topics->pluck('att_name')->toArray();
            
            // Construct image path - assuming filename only is stored in database
            $imagePath = null;
            if ($author->aut_photo) {
                // Check if it's a full URL
                if (filter_var($author->aut_photo, FILTER_VALIDATE_URL)) {
                    $imagePath = $author->aut_photo;
                } else {
                    // Construct path to public/images directory
                    $imagePath = asset('images/' . $author->aut_photo);
                }
            }
            
            return [
                'id' => $author->aut_id,
                'name' => $author->aut_name,
                'image' => $imagePath,
                'description' => $author->aut_body,
                'badges' => $badges
            ];
        });

        $newsletters = Newsletter::with('categories')->get()->map(function($newsletter) {
            $categories = $newsletter->categories->pluck('cat_name')->toArray();

            return [
                'id' => $newsletter->new_id,
                'title' => $newsletter->new_title,
                'frequency' => Newsletter::$frequencyOptions[$newsletter->new_frequency] ?? 'Não definido',
                'hour' => $newsletter->new_hour,
                'icon' => $newsletter->new_icon,
                'estimate_date' => $newsletter->new_estimate_date,
                'status' => $newsletter->new_status,
                'body' => $newsletter->new_body,
                'categories' => $categories,
                'author' => $newsletter->authors->pluck('aut_name')->first() ?? 'Autor não definido'
            ];
        });

        return view('livewire.home', [
            'authors' => $authors,
            'newsletters' => $newsletters,
            'user' => Auth::user()
        ]);
    }
}
