<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceLogResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'service' => new ServiceResource($this->whenLoaded('service')),
            'timestamp' => $this->timestamp,
            'activity_type' => $this->activity_type,
            'notes' => $this->notes,
            'parts_used' => $this->parts_used,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
        ];
    }
}