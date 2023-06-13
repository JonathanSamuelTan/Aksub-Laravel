<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'team' => $this->faker->randomElement([
                'Mercedes', 'Red Bull', 'McLaren', 'Ferrari', 'Alpine', 'AlphaTauri', 'Aston Martin', 'Alfa Romeo', 'Williams', 'Haas'
            ]),
            'picture' => 'default.jpg',
        ];
    }
}
