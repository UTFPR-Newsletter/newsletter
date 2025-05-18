<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterCategory extends Model
{
    protected $table = 'newsletter_categories';
    protected $primaryKey = 'nec_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'newsletter_new_id',
        'category_cat_id',
    ];

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class, 'newsletter_new_id', 'new_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_cat_id', 'cat_id');
    }
}
