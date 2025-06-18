<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $fillable = [
        'notification',
        'content',
        'type',
        'status',
        'is_read',
    ];
    protected $casts = [
        'status'  => 'boolean',
        'is_read' => 'boolean',
    ];
}
