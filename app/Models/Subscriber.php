<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    // Se a sua tabela tiver nome diferente do plural padrão:
    protected $table = 'subscribers';

    // Chave primária customizada:
    protected $primaryKey = 'sub_id';

    // Caso queira que o Eloquent trate a PK como inteiro auto-increment:
    public $incrementing = true;
    protected $keyType = 'int';

    // Se você NÃO quiser que o Eloquent gerencie created_at / updated_at:
    // public $timestamps = false;

    // Campos preenchíveis via create() / fill():
    protected $fillable = [
        'sub_name',
        'sub_email',
    ];
}
