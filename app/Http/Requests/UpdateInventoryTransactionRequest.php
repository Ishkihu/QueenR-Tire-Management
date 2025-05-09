<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInventoryTransactionRequest extends FormRequest
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
            'inventory_id' => 'sometimes|required|exists:inventory,id',
            'quantity_change' => 'sometimes|required|integer',
            'transaction_type' => 'sometimes|required|string|max:50',
            'transaction_date' => 'sometimes|required|date',
            'employee_id' => 'sometimes|required|exists:employee,id',
            'notes' => 'nullable|string',
        ];
    }
}