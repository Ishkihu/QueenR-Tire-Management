<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    public $timestamps = false;

    protected $table = 'sale_item';
    
    protected $fillable = [
        'sale_id',
        'inventory_id',
        'quantity',
        'unit_price',
        'line_total'
    ];

    public function getTable()
    {
        return 'sale_item'; // Force this exact table name
    }

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}