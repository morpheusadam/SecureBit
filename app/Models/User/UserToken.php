<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Model;

class UserToken extends Model
{
    protected $fillable = [
        'user_id',
        'token',
        'device_info',
        'ip_address',
        'expires_at',
        'last_used_at'
    ];

    protected $casts = [
        'device_info' => 'json',
        'expires_at' => 'datetime',
        'last_used_at' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}