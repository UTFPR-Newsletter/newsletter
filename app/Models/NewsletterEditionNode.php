<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterEditionNode extends Model
{
    // Caso o nome da tabela não fosse o plural padrão
    protected $table = 'newsletter_edition_nodes';

    // Chave primária personalizada
    protected $primaryKey = 'nen_id';

    // Sem timestamps auto (created_at / updated_at)
    public $timestamps = false;

    // Mass-assignment
    protected $fillable = [
        'nen_head',
        'nen_title',
        'nen_image',
        'nen_content',
        'newsletter_edition_nee_id',
    ];

    /**
     * Relação com NewsletterEdition
     */
    public function newsletterEdition()
    {
        return $this->belongsTo(
            NewsletterEdition::class,
            'newsletter_edition_nee_id',
            'nee_id'
        );
    }
}
