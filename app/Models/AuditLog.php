<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditLog extends Model
{
    public $timestamps = false;

    protected $table = 'audit_log';
    
    protected $fillable = [
        'table_name',
        'record_id',
        'field_name',
        'old_value',
        'new_value',
        'action_type',
        'timestamp',
        'employee_id'
    ];

    public function getTable()
    {
        return 'audit_log'; // Force this exact table name
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
