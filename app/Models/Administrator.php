<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    // Nome da tabela (plural padrão)
    protected $table = 'administrators';

    // Chave primária personalizada
    protected $primaryKey = 'adm_id';

    // Sem created_at/updated_at automáticos
    public $timestamps = false;

    // Campos preenchíveis em mass-assignment
    protected $fillable = [
        'adm_name',
        'adm_email',
    ];
}
