<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInventoryTransactionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'inventory_id' => 'required|exists:inventory,id',
            'quantity_change' => 'required|integer',
            'transaction_type' => 'required|string|max:50',
            'transaction_date' => 'required|date',
            'employee_id' => 'required|exists:employee,id',
            'notes' => 'nullable|string',
        ];
    }
}