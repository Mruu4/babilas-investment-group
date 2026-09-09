<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name', 'email', 'phone', 'area_of_interest',
        'investment_range', 'message', 'is_read',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];
}
