<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'scheduled_date' => $this->scheduled_date,
            'estimated_duration' => $this->estimated_duration,
            'assigned_employee' => new EmployeeResource($this->whenLoaded('assignedEmployee')),
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'vehicle' => new VehicleResource($this->whenLoaded('vehicle')),
            'status' => $this->status,
        ];
    }
}