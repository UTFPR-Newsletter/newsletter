<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    // nome da tabela (opcional porque Laravel já pluraliza 'authors')
    protected $table = 'authors';

    // chave primária personalizada
    protected $primaryKey = 'aut_id';

    // massa de preenchimento em massa
    protected $fillable = [
        'aut_name',
        'aut_cpf',
        'aut_photo',
        'aut_body',
    ];

    // se o aut_id for inteiro auto-increment, esses valores default servem
    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Relacionamento: um Author tem muitos AuthorTopics
     */
    public function topics()
    {
        return $this->hasMany(AuthorTopic::class, 'author_aut_id', 'aut_id');
    }
}
