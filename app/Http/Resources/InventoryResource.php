<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sku' => $this->sku,
            'vehicleType' => $this->vehicleType,
            'itemType' => $this->itemType,
            'brand' => $this->brand,
            'quantity' => $this->quantity,
            'price' => $this->price,
            'cost' => $this->cost,
            'status' => $this->status,
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
            'last_updated_by' => new EmployeeResource($this->whenLoaded('lastUpdatedBy')),
        ];
    }
}