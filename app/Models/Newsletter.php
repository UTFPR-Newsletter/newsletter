<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{
    protected $table = 'newsletters';
    protected $primaryKey = 'new_id';
    public $incrementing = true;
    protected $keyType = 'int';

    // Constants for newsletter frequency
    public const FREQUENCY_DAILY = 'daily';
    public const FREQUENCY_WEEKLY = 'weekly';
    public const FREQUENCY_BIWEEKLY = 'biweekly';
    public const FREQUENCY_MONTHLY = 'monthly';
    
    // Constants for newsletter status
    public const STATUS_ACTIVE = 'active';
    public const STATUS_PAUSED = 'paused';

    // Constants for newsletter hour
    public const HOUR_10_00 = '10:00';
    public const HOUR_14_00 = '14:00';
    public const HOUR_18_00 = '18:00';
    
    // Available frequency options (for dropdowns, validation, etc)
    public static $frequencyOptions = [
        self::FREQUENCY_DAILY => 'Diária',
        self::FREQUENCY_WEEKLY => 'Semanal',
        self::FREQUENCY_BIWEEKLY => 'Quinzenal',
        self::FREQUENCY_MONTHLY => 'Mensal'
    ];
    
    // Available hour options
    public static $hourOptions = [
        self::HOUR_10_00 => '10:00',
        self::HOUR_14_00 => '14:00',
        self::HOUR_18_00 => '18:00'
    ];
    
    // Available status options
    public static $statusOptions = [
        self::STATUS_ACTIVE => 'Ativa',
        self::STATUS_PAUSED => 'Pausada'
    ];

    protected $fillable = [
        'new_title',
        'new_body',
        'new_icon',
        'new_frequency',
        'new_hour',
        'new_estimate_date',
        'new_status',
    ];

    // Helper method to get human-readable frequency
    public function getFrequencyLabelAttribute()
    {
        return self::$frequencyOptions[$this->new_frequency] ?? $this->new_frequency;
    }
    
    // Helper method to get human-readable status
    public function getStatusLabelAttribute()
    {
        return self::$statusOptions[$this->new_status] ?? $this->new_status;
    }

    // muitos autores ↔️ muitas newsletters (via pivot author_newsletters)
    public function authors()
    {
        return $this->belongsToMany(
            Author::class,
            'author_newsletters',
            'newsletter_new_id',
            'author_aut_id',
            'new_id',
            'aut_id'
        );
    }

    // muitas categorias ↔️ muitas newsletters (via pivot newsletter_categories)
    public function categories()
    {
        return $this->belongsToMany(
            Category::class,
            'newsletter_categories',
            'newsletter_new_id',
            'category_cat_id',
            'new_id',
            'cat_id'
        );
    }
}
