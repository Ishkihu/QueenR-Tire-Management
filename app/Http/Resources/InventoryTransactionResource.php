<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InventoryTransactionResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'inventory' => new InventoryResource($this->whenLoaded('inventory')),
            'quantity_change' => $this->quantity_change,
            'transaction_type' => $this->transaction_type,
            'transaction_date' => $this->transaction_date,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
            'notes' => $this->notes,
        ];
    }
}