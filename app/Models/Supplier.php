<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    public $timestamps = false;

    protected $table = 'supplier';
    
    protected $fillable = [
        'name',
        'contact_person',
        'phone',
        'email',
        'address',
        'account_number',
        'status'
    ];

    public function getTable()
    {
        return 'supplier'; // Force this exact table name
    }

    protected $enumStatus = ['active', 'inactive'];

    public function inventory()
    {
        return $this->hasMany(Inventory::class);
    }
}