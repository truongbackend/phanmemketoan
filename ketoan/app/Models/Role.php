<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    protected $fillable = [
        'name',
        'guard_name',
        'note',
        'status',
        'default_role'
    ];
    protected static function booted()
    {
        static::saving(function (Role $role) {
            if ($role->default_role	) {
                self::where('id', '!=', $role->id)
                    ->update(['default_role' => false]);
            }

        });
    }
}
