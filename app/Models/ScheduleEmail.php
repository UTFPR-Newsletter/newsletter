<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleEmail extends Model
{
    // Nome da tabela (plural snake-case padrão)
    protected $table = 'schedule_emails';

    // Chave primária personalizada
    protected $primaryKey = 'sce_id';

    // Sem created_at / updated_at automáticos
    public $timestamps = false;

    // Campos preenchíveis em mass-assignment
    protected $fillable = [
        'sce_send_date',
        'sce_status',
        'newsletter_edition_nee_id',
    ];

    /**
     * Relação: este envio pertence a uma NewsletterEdition
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
