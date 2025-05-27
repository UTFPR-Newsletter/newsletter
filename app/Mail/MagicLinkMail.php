<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;

class MagicLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $magicUrl;

    public function __construct(User $user, string $magicUrl)
    {
        $this->user = $user;
        $this->magicUrl = $magicUrl;
    }

    public function build()
    {
        return $this->view('emails.magic-link')
                    ->subject('Seu Link Mágico de Acesso - WebNews');
    }
} 