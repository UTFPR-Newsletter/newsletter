<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorTopic extends Model
{
    // nome da tabela (opcional pois Laravel infere 'author_topics')
    protected $table = 'author_topics';

    // chave primária personalizada
    protected $primaryKey = 'att_id';

    // preenchíveis
    protected $fillable = [
        'att_name',
        'att_color',
        'author_aut_id',
    ];

    public $incrementing = true;
    protected $keyType = 'int';

    /**
     * Relacionamento: um AuthorTopic pertence a um Author
     */
    public function author()
    {
        return $this->belongsTo(Author::class, 'author_aut_id', 'aut_id');
    }
}
