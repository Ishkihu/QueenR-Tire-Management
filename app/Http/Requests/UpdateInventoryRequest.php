<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $inventoryId = $this->route('inventory')->id ?? null;

        return [
            'sku' => 'nullable|string|max:50',
            'vehicleType' => 'nullable|string|max:50',
            'itemType' => 'nullable|string|max:50',
            'brand' => 'nullable|string|max:100',
            'quantity' => 'sometimes|required|integer|min:0',
            'price' => 'sometimes|required|numeric|min:0',
            'cost' => 'sometimes|required|numeric|min:0',
            'last_updated_by' => 'nullable|exists:employee,id',
            'status' => 'sometimes|required|in:active,low,discontinued',
            'supplier_id' => 'nullable|exists:supplier,id',
        ];
    }
}