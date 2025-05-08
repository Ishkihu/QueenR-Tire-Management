<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;

    protected $table = 'payment';
    
    protected $fillable = [
        'sale_id',
        'service_id',
        'customer_id',
        'transaction_code',
        'payment_date',
        'payment_method',
        'amount',
        'reference_number',
        'status',
        'employee_id'
    ];

    public function getTable()
    {
        return 'payment'; // Force this exact table name
    }


    protected $enumPaymentMethod = ['cash', 'credit_card', 'bank_transfer'];
    protected $enumStatus = ['pending', 'completed', 'failed'];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}