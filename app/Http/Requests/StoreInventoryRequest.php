<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sku' => 'nullable|string|max:50',
            'vehicleType' => 'nullable|string|max:50',
            'itemType' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:100',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'cost' => 'required|numeric|min:0',
            'last_updated_by' => 'nullable|exists:employee,id',
            'status' => 'required|in:active,low,discontinued',
            'supplier_id' => 'nullable|exists:supplier,id',
        ];
    }
}