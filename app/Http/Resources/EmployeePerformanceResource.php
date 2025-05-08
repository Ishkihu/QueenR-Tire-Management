<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeePerformanceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
            'period_start_date' => $this->period_start_date,
            'period_end_date' => $this->period_end_date,
            'total_sales' => $this->total_sales,
            'total_services' => $this->total_services,
            'performance_rating' => $this->performance_rating,
        ];
    }
}