<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    public $timestamps = false;

    protected $table = 'customer';
    
    protected $fillable = [
        'customer_number',
        'firstName',
        'lastName',
        'contact',
        'email',
        'address'
    ];

    public function getTable()
    {
        return 'customer'; // Force this exact table name
    }

    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
