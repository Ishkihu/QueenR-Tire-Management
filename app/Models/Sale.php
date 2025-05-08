<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public $timestamps = false;

    protected $table = 'sale';
    
    protected $fillable = [
        'invoice_number',
        'sale_date',
        'subtotal',
        'tax_amount',
        'total_amount',
        'employee_id',
        'customer_id'
    ];

    public function getTable()
    {
        return 'sale'; // Force this exact table name
    }

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
}