<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeePerformance extends Model
{
    public $timestamps = false;

    protected $table = 'employee_performance';
    
    protected $fillable = [
        'employee_id',
        'period_start_date',
        'period_end_date',
        'total_sales',
        'total_services',
        'performance_rating'
    ];

    public function getTable()
    {
        return 'employee_performance'; // Force this exact table name
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}