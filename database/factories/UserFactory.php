<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected static ?string $password = null;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => $this->faker->randomElement(['superadmin', 'admin', 'superuser', 'user']),
            'employee_id' => Employee::inRandomOrder()->value('id'),
            'remember_token' => Str::random(10),
        ];
    }

    public function unverified(): static
    {
        return $this->state(fn () => ['email_verified_at' => null]);
    }

    public function admin(): static
    {
        return $this->state(fn () => ['role' => 'admin']);
    }

    public function user(): static
    {
        return $this->state(fn () => ['role' => 'user']);
    }

    public function superadmin(): static
    {
        return $this->state(fn () => [
            'role' => 'superadmin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
