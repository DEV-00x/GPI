<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Equipment extends Model
{
    use HasFactory;

    protected $table = 'equipments';
    
    protected $fillable = [
        'inventory_number',
        'category',
        'type',
        'status',
        'location',
        'assigned_employee_id',
    ];

    /* RELATIONS------------------------------------------*/

    public function assignedEmployee(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'assigned_employee_id');
    }
    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class);
    }
}
