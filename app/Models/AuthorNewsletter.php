<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuthorNewsletter extends Model
{
    protected $table = 'author_newsletters';
    protected $primaryKey = 'aun_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'author_aut_id',
        'newsletter_new_id',
    ];

    public function author()
    {
        return $this->belongsTo(Author::class, 'author_aut_id', 'aut_id');
    }

    public function newsletter()
    {
        return $this->belongsTo(Newsletter::class, 'newsletter_new_id', 'new_id');
    }
}
