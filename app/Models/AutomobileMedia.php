<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AutomobileMedia extends Model
{
    protected $fillable = [
        'automobile_id', 'path', 'type', 'caption', 'is_primary', 'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function automobile(): BelongsTo
    {
        return $this->belongsTo(Automobile::class);
    }
}
