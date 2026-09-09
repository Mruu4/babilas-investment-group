<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AgricultureProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'location', 'agriculture_type', 'description',
        'investment_information', 'status', 'is_featured', 'created_by',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(AgricultureMedia::class)->orderBy('sort_order');
    }
}
