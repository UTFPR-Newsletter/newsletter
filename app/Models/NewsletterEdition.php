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

    public const STATUS_WRITING = 'writing';
    public const STATUS_WAITING_REVIEW = 'waiting_review';
    public const STATUS_REVIEWING = 'reviewing';
    public const STATUS_REVIEWED = 'reviewed';
    public const STATUS_PENDING = 'pending';
    public const STATUS_SENT = 'sent';
    public const STATUS_CANCELED = 'canceled';

    public static $statusOptions = [
        self::STATUS_WRITING => 'Escrevendo',
        self::STATUS_WAITING_REVIEW => 'Aguardando Revisão',
        self::STATUS_REVIEWING => 'Revisando',
        self::STATUS_REVIEWED => 'Revisado',
        self::STATUS_PENDING => 'Pendente',
        self::STATUS_SENT => 'Enviado',
        self::STATUS_CANCELED => 'Cancelado',
    ];

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
