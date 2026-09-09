<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TechnologyProject extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'sector', 'description', 'investment_stage',
        'investment_information', 'website', 'status', 'is_featured', 'created_by',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(TechnologyMedia::class)->orderBy('sort_order');
    }
}
