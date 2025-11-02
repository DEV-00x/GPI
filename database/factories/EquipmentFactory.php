<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EquipmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'inventory_number' => strtoupper($this->faker->bothify('MOP####')),
            'category' => $this->faker->randomElement(['it', 'furniture', 'vehicle', 'other']),
            'type' => $this->faker->word(),
            'status' => $this->faker->randomElement(['active', 'inactive', 'maintenance', 'retired']),
            'location' => $this->faker->city(),
            'assigned_employee_id' => Employee::inRandomOrder()->value('id'),
        ];
    }
}
