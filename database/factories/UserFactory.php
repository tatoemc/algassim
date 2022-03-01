<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = User::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => '$2y$10$SgBWBk5c0t8WarGqLDfogu8HPoWh73gBThjJBlNU/mysFxeR8a8vG', // newday77
            'user_type' => ('sponsor'),
            //'user_type' => ('guardian'),
            'gender' => $this->faker->randomElement(['ذكر', 'انثى']),
            'phone' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'bank_account' => $this->faker->numberBetween($min = 1000, $max = 9000),
            'add' => $this->faker->Address(),
            'ssn' => $this->faker->randomDigit(),
            'roles_name' => $this->faker->randomElement(['user', 'admin']),
            'created_at' => \Carbon\Carbon::now(),
            'updated_at' => \Carbon\Carbon::now(),

        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
