<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    public $timestamps = false;

    protected $table = 'service';
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'scheduled_date',
        'estimated_duration',
        'assigned_employee_id',
        'customer_id',
        'vehicle_id',
        'status'
    ];

    public function getTable()
    {
        return 'service'; // Force this exact table name
    }

    protected $enumStatus = ['scheduled', 'in-progress', 'completed'];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'assigned_employee_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function serviceLogs()
    {
        return $this->hasMany(ServiceLog::class);
    }
}