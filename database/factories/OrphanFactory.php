<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Orphan;
use App\Models\Sponsor;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Orphan>
 */
class OrphanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

     protected $model = Orphan::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'gender' => $this->faker->randomElement(['ذكر', 'انثى']),
            'b_date' => \Carbon\Carbon::now(),
            'schoolLevel' => $this->faker->numberBetween($min = 1, $max = 10),
            'add' => $this->faker->Address(),
            'ssn' => $this->faker->randomDigit(),
            'helth_state' => $this->faker->randomElement(['سليم','مريض']),
            'father_deth' => \Carbon\Carbon::now(),
            'brother_count' => $this->faker->numberBetween($min = 1, $max = 8),
            'stauts' => ('0'),
            'user_id' => Sponsor::factory(),
        ];
    }
}
