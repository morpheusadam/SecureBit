<?php

namespace Database\Factories;

use App\Models\User\UserProfile;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    protected $model = UserProfile::class;

    public function definition()
    {
        return [
            'user_id' => null, // This will be set when creating the relationship
            'full_name' => $this->faker->name(),
            'bio' => $this->faker->sentence(),
            'avatar_url' => 'https://i.pravatar.cc/300?u='.$this->faker->unique()->email,
            'settings' => json_encode([
                'theme' => 'light',
                'notifications' => true
            ]),
        ];
    }
}