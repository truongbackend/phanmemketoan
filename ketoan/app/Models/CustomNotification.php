<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomNotification extends Model
{
    protected $fillable = ['title','content','type'];

    public function recipients()
    {
        return $this->belongsToMany(
            User::class,
            'notification_user',
            'notification_id',
            'user_id'
        )
        ->withPivot('read_at')
        ->withTimestamps();
    }
    use HasFactory;
}
