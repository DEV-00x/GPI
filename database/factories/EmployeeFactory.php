<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'registration_number' => strtoupper($this->faker->bothify('26####')),
            'department_id' => Department::inRandomOrder()->value('id'),
        ];
    }
}
