<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialSummary extends Model
{
    public $timestamps = false;

    protected $table = 'financial_summary';
    
    protected $fillable = [
        'period_start_date',
        'period_end_date',
        'total_revenue',
        'total_expenses',
        'net_profit',
        'total_sales',
        'total_services',
        'customer_count',
        'generated_by'
    ];

    public function getTable()
    {
        return 'financial_summary'; // Force this exact table name
    }


    public function generator()
    {
        return $this->belongsTo(Employee::class, 'generated_by');
    }
}