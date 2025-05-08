<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VehicleResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'car_brand' => $this->car_brand,
            'model' => $this->model,
            'year' => $this->year,
            'license_plate' => $this->license_plate,
        ];
    }
}