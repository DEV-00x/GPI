<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use  HasFactory,Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'employee_id',
    ];
    protected $hidden = [
        'password',
        'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* RELATIONS------------------------------------------*/

    public function employee(): BelongsTo
    {
        return $this->belongsTo(Employee::class);
    }
    public function maintenances(): HasMany
    {
        return $this->hasMany(Maintenance::class, 'technician_user_id');
    }

    /* HELPERS------------------------------------------*/
    public function isAdmin(): bool
    {
        return in_array($this->role, ['admin', 'superadmin', 'superuser']);
    }
}
