<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserProfileFactory extends Factory
{
    protected $model = \App\Models\User\UserProfile::class;

    public function definition()
    {
        return [
            'full_name' => $this->faker->name(),
            'bio' => $this->faker->sentence(),
            'avatar_url' => 'https://i.pravatar.cc/300?u='.$this->faker->unique()->email,
            'settings' => json_encode([]),
        ];
    }
}