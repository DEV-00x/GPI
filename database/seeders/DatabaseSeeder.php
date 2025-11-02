<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Equipment;
use App\Models\Demand;
use App\Models\Maintenance;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*--------------------------------------------*/
        $itDept = Department::create([
            'name' => 'DAP',
            'type' => 'direction',
        ]);

        $maintenanceDept = Department::create([
            'name' => 'Informatique',
            'parent_department_id' => $itDept->id,
            'type' => 'service',
        ]);

        /*--------------------------------------------*/
        $employee1 = Employee::create([
            'name' => 'Ali Ben Salah',
            'registration_number' => '260001',
            'department_id' => $itDept->id,
        ]);

        $employee2 = Employee::create([
            'name' => 'Sara Khelifi',
            'registration_number' => '260002',
            'department_id' => $maintenanceDept->id,
        ]);

        Employee::factory(17)->create([
            'department_id' => $maintenanceDept->id,
        ]);

        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@local.me',
            'password' => Hash::make('password'),
            'role' => 'superadmin',
            'employee_id' => $employee1->id,
            'remember_token' => Str::random(10),
        ]);

        User::factory(15)->create([
            'employee_id' => $employee2->id,
        ]);


        $equipment1 = Equipment::create([
            'inventory_number' => 'EQ-001',
            'category' => 'it',
            'type' => 'Laptop',
            'status' => 'active',
            'location' => 'Bureau 101',
            'assigned_employee_id' => $employee1->id,
        ]);

        $equipment2 = Equipment::create([
            'inventory_number' => 'EQ-002',
            'category' => 'furniture',
            'type' => 'Bureau en bois',
            'status' => 'active',
            'location' => 'Salle 3',
            'assigned_employee_id' => $employee2->id,
        ]);


        Equipment::factory(12)->create();

        $demand = Demand::create([
            'reference_number' => 'DEM-001',
            'title' => 'Réparation ordinateur portable',
            'type' => 'maintenance',
            'requested_by_employee_id' => $employee1->id,
            'status' => 'pending',
            'description' => 'Le PC ne démarre plus correctement.',
        ]);

        Demand::factory(13)->create();


        Maintenance::create([
            'reference_number' => 'MAIN-001',
            'equipment_id' => $equipment1->id,
            'technician_user_id' => $superAdmin->id,
            'related_demand_id' => $demand->id,
            'type' => 'corrective',
            'description' => 'Remplacement du disque dur.',
            'start_date' => now()->subDays(2),
            'end_date' => now()->subDay(),
            'status' => 'completed',
        ]);

        Maintenance::factory(14)->create();

        $this->command->info('Database seeded successfully!');
        $this->command->info('Admin login: admin@local.me / password');
    }
}
