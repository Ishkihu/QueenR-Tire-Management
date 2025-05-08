<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FinancialSummaryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'period_start_date' => $this->period_start_date,
            'period_end_date' => $this->period_end_date,
            'total_revenue' => $this->total_revenue,
            'total_expenses' => $this->total_expenses,
            'net_profit' => $this->net_profit,
            'total_sales' => $this->total_sales,
            'total_services' => $this->total_services,
            'customer_count' => $this->customer_count,
            'generated_by' => new EmployeeResource($this->whenLoaded('generatedBy')),
        ];
    }
}