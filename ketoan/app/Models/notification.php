<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    use HasFactory;
    protected $fillable = [
        'type',
        'content',
        'is_read',
    ];
    protected $casts = [
        'is_read' => 'boolean',
        'timestamp' => 'datetime', // Cast timestamp to Carbon instance
    ];
}
