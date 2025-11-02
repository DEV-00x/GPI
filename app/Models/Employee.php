<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'name',
        'registration_number',
        'department_id',
    ];


    /* RELATIONS------------------------------------------*/

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }
    public function equipments(): HasMany
    {
        return $this->hasMany(Equipment::class, 'assigned_employee_id');
    }
    public function demands(): HasMany
    {
        return $this->hasMany(Demand::class, 'requested_by_employee_id');
    }
}

