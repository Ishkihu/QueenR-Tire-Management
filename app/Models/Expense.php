<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    public $timestamps = false;

    protected $table = 'expense';
    
    protected $fillable = [
        'category',
        'amount',
        'transaction_date',
        'approved_by',
        'supplier_id'
    ];

    public function getTable()
    {
        return 'expense'; // Force this exact table name
    }


    public function approver()
    {
        return $this->belongsTo(Employee::class, 'approved_by');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}