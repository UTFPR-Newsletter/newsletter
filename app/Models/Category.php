<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'cat_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'cat_name',
        'cat_description',
    ];

    public function newsletters()
    {
        return $this->belongsToMany(
            Newsletter::class,
            'newsletter_categories',
            'category_cat_id',
            'newsletter_new_id',
            'cat_id',
            'new_id'
        );
    }
}
