<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'sale' => new SaleResource($this->whenLoaded('sale')),
            'service' => new ServiceResource($this->whenLoaded('service')),
            'customer' => new CustomerResource($this->whenLoaded('customer')),
            'transaction_code' => $this->transaction_code,
            'payment_date' => $this->payment_date,
            'payment_method' => $this->payment_method,
            'amount' => $this->amount,
            'reference_number' => $this->reference_number,
            'status' => $this->status,
            'employee' => new EmployeeResource($this->whenLoaded('employee')),
        ];
    }
}