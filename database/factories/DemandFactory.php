<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class DemandFactory extends Factory
{
    public function definition(): array
    {
        return [
            'reference_number' => strtoupper($this->faker->bothify('DEM-####')),
            'title' => ucfirst($this->faker->words(3, true)),
            'type' => $this->faker->randomElement(['maintenance', 'supply', 'purchase', 'other']),
            'requested_by_employee_id' => Employee::inRandomOrder()->value('id'),
            'status' => $this->faker->randomElement(['pending', 'in_progress', 'completed', 'cancelled']),
            'description' => $this->faker->paragraph(),
        ];
    }
}
