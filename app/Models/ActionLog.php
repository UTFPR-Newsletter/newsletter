<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActionLog extends Model
{
    // Tabela padrão plural
    protected $table = 'action_logs';

    // Chave primária personalizada
    protected $primaryKey = 'acl_id';

    // Sem timestamps automáticos
    public $timestamps = false;

    // Campos preenchíveis
    protected $fillable = [
        'acl_model',
        'acl_action',
        'acl_description',
        'acl_object',
        'acl_date',
        'acl_time',
        'acl_model_id',
        'users_usr_id',
    ];

    /**
     * Ação registrada por um usuário
     */
    public function user()
    {
        return $this->belongsTo(
            User::class,
            'users_usr_id',
            'usr_id'
        );
    }
}
