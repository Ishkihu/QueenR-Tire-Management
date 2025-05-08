<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    public $timestamps = false;

    protected $table = 'inventory';
    
    protected $fillable = [
        'sku',
        'vehicleType',
        'itemType',
        'brand',
        'quantity',
        'price',
        'cost',
        'last_updated_by',
        'status',
        'supplier_id'
    ];

    public function getTable()
    {
        return 'inventory'; // Force this exact table name
    }


    protected $enumStatus = ['active', 'low', 'discontinued'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}