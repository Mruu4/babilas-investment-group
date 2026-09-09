<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AgricultureMedia extends Model
{
    protected $fillable = [
        'agriculture_project_id', 'path', 'type', 'caption', 'is_primary', 'sort_order',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(AgricultureProject::class, 'agriculture_project_id');
    }
}
