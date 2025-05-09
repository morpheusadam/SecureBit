<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $fillable = [
        'group',
        'name',
        'title',
        'machine_description',
        'guard_name'
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_permission')
            ->withTimestamps();
    }
}