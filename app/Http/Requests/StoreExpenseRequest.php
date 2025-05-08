<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category' => 'required|string|max:100',
            'amount' => 'required|numeric|min:0',
            'transaction_date' => 'required|date',
            'approved_by' => 'required|exists:employee,id',
            'supplier_id' => 'required|exists:supplier,id',
        ];
    }
}