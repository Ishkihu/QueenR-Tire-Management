<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSupplierRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $supplierId = $this->route('supplier')->id ?? null;

        return [
            'name' => 'sometimes|required|string|max:100',
            'contact_person' => 'sometimes|required|string|max:50',
            'phone' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:200',
            'account_number' => 'nullable|string|max:30',
            'status' => 'sometimes|required|in:active,inactive',
        ];
    }
}