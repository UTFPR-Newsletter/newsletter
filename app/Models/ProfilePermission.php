<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProfilePermission extends Model
{
    // Nome da tabela (segue o plural padrão)
    protected $table = 'profile_permissions';

    // Chave primária personalizada
    protected $primaryKey = 'prf_id';

    // Não usamos created_at/updated_at
    public $timestamps = false;

    public const LEVEL_ADMIN = 'admin';
    public const LEVEL_SUBSCRIBER = 'subscriber';
    public const LEVEL_AUTHOR = 'author';

    // Campos que podem ser preenchidos em mass-assignment
    protected $fillable = [
        'prf_area',
        'prf_action',
        'prf_level',
    ];
}
