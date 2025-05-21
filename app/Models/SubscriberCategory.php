<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubscriberCategory extends Model
{
    // Chave primária personalizada
    protected $primaryKey = 'suc_id';

    // Sem created_at / updated_at
    public $timestamps = false;

    // Mass-assignment
    protected $fillable = [
        'subscriber_sub_id',
        'category_cat_id',
    ];

    /**
     * Relação com Subscriber
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
     * Relação com Category
     */
    public function category()
    {
        return $this->belongsTo(
            Category::class,
            'category_cat_id',
            'cat_id'
        );
    }
}
