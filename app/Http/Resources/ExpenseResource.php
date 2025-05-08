<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'category' => $this->category,
            'amount' => $this->amount,
            'transaction_date' => $this->transaction_date,
            'approved_by' => new EmployeeResource($this->whenLoaded('approvedBy')),
            'supplier' => new SupplierResource($this->whenLoaded('supplier')),
        ];
    }
}