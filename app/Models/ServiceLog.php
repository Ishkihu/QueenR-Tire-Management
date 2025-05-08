<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ServiceLog extends Model
{
    public $timestamps = false;

    protected $table = 'service_log';
    
    protected $fillable = [
        'service_id',
        'timestamp',
        'activity_type',
        'notes',
        'parts_used',
        'employee_id'
    ];

    public function getTable()
    {
        return 'service_log'; // Force this exact table name
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}