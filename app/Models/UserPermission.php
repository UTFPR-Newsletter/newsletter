<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserPermission extends Model
{
    // Nome da tabela (padrão plural)
    protected $table = 'user_permissions';

    // Chave primária personalizada
    protected $primaryKey = 'usp_id';

    // Sem timestamps automáticos
    public $timestamps = false;

    // Mass-assignment
    protected $fillable = [
        'usp_area',
        'usp_action',
        'users_usr_id',
    ];

    /**
     * Relação: esta permissão pertence a um User
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
