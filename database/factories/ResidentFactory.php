<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Resident>
 */
class ResidentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $gender = fake()->randomElement(['male', 'female']);
        
        return [
            'nik' => fake()->numerify('36##############'), // NIK Banten/Lebak starts with 36
            'name' => fake()->name($gender),
            'gender' => $gender,
            'birth_place' => fake()->city(),
            'birth_date' => fake()->date('Y-m-d', '-17 years'),
            'address' => fake()->address(),
            'religion' => fake()->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
            'marital_status' => fake()->randomElement(['single', 'married', 'divorced', 'widowed']),
            'occupation' => fake()->jobTitle(),
            'phone' => fake()->phoneNumber(),
            'dusun' => fake()->randomElement(['Dusun I', 'Dusun II', 'Dusun III']),
            'status' => fake()->randomElement(['active', 'active', 'active', 'moved', 'deceased']), // mostly active
        ];
    }
}