<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_number' => $this->customer_number,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'contact' => $this->contact,
            'email' => $this->email,
            'address' => $this->address,
        ];
    }
}