<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Investment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', 'slug', 'category', 'description', 'investment_value',
        'current_value', 'performance_percent', 'return_information',
        'publicly_visible', 'status', 'investment_date', 'created_by',
    ];

    protected $casts = [
        'publicly_visible' => 'boolean',
        'investment_value' => 'decimal:2',
        'current_value' => 'decimal:2',
        'performance_percent' => 'decimal:2',
        'investment_date' => 'date',
    ];

    public function media(): HasMany
    {
        return $this->hasMany(InvestmentMedia::class)->orderBy('sort_order');
    }
}
