<?php

namespace App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'full_name',
        'bio',
        'avatar_url',
        'settings'
    ];

    protected $casts = [
        'settings' => 'json'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
        protected static function newFactory()
    {
        return \Database\Factories\UserProfileFactory::new();
    }
}