<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    public $timestamps = false;

    protected $table = 'vehicle';
    
    protected $fillable = [
        'customer_id',
        'car_brand',
        'model',
        'year',
        'license_plate'
    ];

    public function getTable()
    {
        return 'vehicle'; // Force this exact table name
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }
}
