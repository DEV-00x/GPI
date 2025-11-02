<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /* Departments Table=========================================================== */
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('parent_department_id')
                ->nullable()
                ->constrained('departments', 'id')
                ->nullOnDelete()
                ->index();
            $table->enum('type', ['direction','service']);
            $table->timestamps();
        });

        /* Employees Table=========================================================== */
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('registration_number')->unique();
            $table->foreignId('department_id')
                ->nullable()
                ->constrained('departments')
                ->nullOnDelete()
                ->cascadeOnUpdate()
                ->index();
            $table->timestamps();
        });

        /* Users Table=========================================================== */
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['superadmin', 'admin', 'superuser', 'user'])->default('user');
            $table->foreignId('employee_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete()
                ->cascadeOnUpdate()
                ->index();
            $table->rememberToken();
            $table->timestamps();
        });

        /* Equipments Table=========================================================== */
        Schema::create('equipments', function (Blueprint $table) {
            $table->id();
            $table->string('inventory_number')->unique();
            $table->enum('category', ['it', 'furniture', 'vehicle', 'other'])->default('other');
            $table->string('type')->nullable();
            $table->enum('status', ['active', 'inactive', 'maintenance', 'retired'])->default('active');
            $table->string('location')->nullable();
            $table->foreignId('assigned_employee_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete()
                ->index();
            $table->timestamps();

            $table->index(['status', 'category']);
        });

        /* Demands Table=========================================================== */
        Schema::create('demands', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->string('title');
            $table->enum('type', ['maintenance', 'supply', 'purchase', 'other'])->default('other');
            $table->foreignId('requested_by_employee_id')
                ->nullable()
                ->constrained('employees')
                ->nullOnDelete()
                ->index();
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled'])->default('pending');
            $table->text('description')->nullable();
            $table->timestamps();

            $table->index(['status', 'type']);
        });

        /* Maintenances Table=========================================================== */
        Schema::create('maintenances', function (Blueprint $table) {
            $table->id();
            $table->string('reference_number')->unique();
            $table->foreignId('equipment_id')
                ->constrained('equipments')
                ->cascadeOnDelete()
                ->cascadeOnUpdate()
                ->index();
            $table->foreignId('technician_user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->index();
            $table->foreignId('related_demand_id')
                ->nullable()
                ->constrained('demands')
                ->nullOnDelete()
                ->index();
            $table->enum('type', ['preventive', 'corrective'])->default('corrective');
            $table->text('description')->nullable();
            $table->dateTime('start_date');
            $table->dateTime('end_date')->nullable();
            $table->enum('status', ['planned', 'in_progress', 'completed', 'cancelled'])->default('planned');
            $table->timestamps();

            $table->index(['status', 'type']);
        });

        /* Password Reset Tokens=========================================================== */
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        /* Sessions Table=========================================================== */
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete()
                ->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }


    public function down(): void
    {
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('maintenances');
        Schema::dropIfExists('demands');
        Schema::dropIfExists('equipments');
        Schema::dropIfExists('users');
        Schema::dropIfExists('employees');
        Schema::dropIfExists('departments');
    }
};
