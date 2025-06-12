<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class package extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'note', 'price', 'discould', 'status', 'expiration_time','default_packages'
    ];
    protected static function booted()
    {
        static::saving(function (Package $package) {
            if ($package->default_packages) {

                self::where('id', '!=', $package->id)
                    ->update(['default_packages' => false]);
            }

        });
    }
}
