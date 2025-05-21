<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterEdition extends Model
{
    // nome da tabela (caso não seja o plural padrão “newsletter_editions”)
    protected $table = 'newsletter_editions';

    // chave primária personalizada
    protected $primaryKey = 'nee_id';

    // se não houver created_at / updated_at
    public $timestamps = false;

    // campos que podem ser preenchidos em mass-assignment
    protected $fillable = [
        'nee_estimate_date',
        'nee_status',
        'nee_sent_date',
        'nee_header_image',
        'nee_views',
        'newsletter_new_id',
        'newsletter_review',
    ];

    /**
     * Relação com o Newsletter
     */
    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class, 'newsletter_new_id', 'new_id');
    }
}
