<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'note', 'price', 'discould', 'status', 'expiration_time', 'user_create',
    ];
}
