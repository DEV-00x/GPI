<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $table = 'departments';

    protected $fillable = [
        'name',
        'parent_department_id',
        'type',
    ];

    /* RELATIONS------------------------------------------*/

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'parent_department_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Department::class, 'parent_department_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(Employee::class);
    }
    public function department(): BelongsTo
{
    return $this->belongsTo(Department::class);
}


    /* SCOPES---------------------------------------------*/

    public function scopeDirections($query)
    {
        return $query->where('type', 'Direction');
    }

    public function scopeServices($query)
    {
        return $query->where('type', 'Service');
    }
}
