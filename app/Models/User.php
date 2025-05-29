<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    // Tabela padrão "users"
    protected $primaryKey = 'usr_id';

    // Sem created_at / updated_at automáticos
    public $timestamps = false;

    public const LEVEL_ADMIN = 'admin';
    public const LEVEL_SUBSCRIBER = 'subscriber';
    public const LEVEL_AUTHOR = 'author';

    // Campos mass assignable
    protected $fillable = [
        'usr_email',
        'usr_password',
        'usr_level',
        'usr_active',
        'usr_has_magic_link',
        'usr_magic_link',
        'usr_magic_link_expires_at',
        'represented_agent_id',
    ];

    public function subscriber() {
        return $this->hasOne(Subscriber::class, 'sub_id', 'represented_agent_id');
    }

    public function author() {
        return $this->hasOne(Author::class, 'aut_id', 'represented_agent_id');
    }
}
