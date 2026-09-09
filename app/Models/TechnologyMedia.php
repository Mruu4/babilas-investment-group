<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TechnologyMedia extends Model
{
    protected $fillable = [
        'technology_project_id', 'path', 'type', 'caption', 'is_primary', 'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(TechnologyProject::class, 'technology_project_id');
    }
}
