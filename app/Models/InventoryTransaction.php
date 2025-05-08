<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    public $timestamps = false;

    protected $table = 'inventory_transaction';
    
    protected $fillable = [
        'inventory_id',
        'quantity_change',
        'transaction_type',
        'transaction_date',
        'employee_id',
        'notes'
    ];

    public function getTable()
    {
        return 'inventory_transaction'; // Force this exact table name
    }


    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
