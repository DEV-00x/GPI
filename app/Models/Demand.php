<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Demand extends Model
{
     use HasFactory;

     protected $table = 'demands';

    protected $fillable = [
        'reference_number',
        'title',
        'type',
        'requested_by_employee_id',
        'status',
        'description',
    ];

    /* RELATIONS------------------------------------------*/

    public function requestedBy(): BelongsTo
    {
        return $this->belongsTo(Employee::class, 'requested_by_employee_id');
    }
    public function maintenance(): HasOne
    {
        return $this->hasOne(Maintenance::class, 'related_demand_id');
    }
}
