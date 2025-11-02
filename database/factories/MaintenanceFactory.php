<?php

namespace Database\Factories;

use App\Models\Equipment;
use App\Models\User;
use App\Models\Demand;
use Illuminate\Database\Eloquent\Factories\Factory;

class MaintenanceFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-2 months', 'now');
        $end = $this->faker->boolean(70) ? $this->faker->dateTimeBetween($start, 'now') : null;

        return [
            'reference_number' => strtoupper($this->faker->unique()->bothify('MAIN####')),
            'equipment_id' => Equipment::inRandomOrder()->value('id'),
            'technician_user_id' => User::inRandomOrder()->value('id'),
            'related_demand_id' => Demand::inRandomOrder()->value('id'),
            'type' => $this->faker->randomElement(['preventive', 'corrective']),
            'description' => $this->faker->sentence(),
            'start_date' => $start,
            'end_date' => $end,
            'status' => $this->faker->randomElement(['planned', 'in_progress', 'completed', 'cancelled']),
        ];
    }
}
