<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Automobile extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'brand', 'model', 'year', 'price', 'mileage',
        'condition_status', 'specifications', 'availability', 'description',
        'video_url', 'is_featured', 'created_by',
    ];

    protected $casts = [
        'specifications' => 'array',
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(AutomobileMedia::class)->orderBy('sort_order');
    }
}
