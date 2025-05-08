<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    public $timestamps = false;

    protected $table = 'employee';
    
    protected $fillable = [
        'employee_code',
        'firstName',
        'lastName',
        'email',
        'phone',
        'role_id',
        'status'
    ];

    public function getTable()
    {
        return 'employee'; // Force this exact table name
    }

    protected $enumStatus = ['active', 'on-leave', 'terminated'];

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'assigned_employee_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}