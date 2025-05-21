<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriberNewsletter extends Model
{
    // tabela (padrão plural) e PK personalizada
    protected $table = 'subscriber_newsletters';
    protected $primaryKey = 'sun_id';

    // sem created_at / updated_at
    public $timestamps = false;

    // campos fillable
    protected $fillable = [
        'sun_active',
        'subscriber_sub_id',
        'newsletter_new_id',
    ];

    /**
     * Relação: este registro pertence a um Subscriber
     */
    public function subscriber()
    {
        return $this->belongsTo(
            Subscriber::class,
            'subscriber_sub_id',
            'sub_id'
        );
    }

    /**
     * Relação: este registro pertence a um Newsletter
     */
    public function newsletter()
    {
        return $this->belongsTo(
            Newsletter::class,
            'newsletter_new_id',
            'new_id'
        );
    }
}
