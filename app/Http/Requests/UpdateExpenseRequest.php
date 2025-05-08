<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => 'sometimes|required|string|max:100',
            'amount' => 'sometimes|required|numeric|min:0',
            'transaction_date' => 'sometimes|required|date',
            'approved_by' => 'sometimes|required|exists:employee,id',
            'supplier_id' => 'sometimes|required|exists:supplier,id',
        ];
    }
}