<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePaymentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'sale_id' => 'nullable|exists:sale,id',
            'service_id' => 'nullable|exists:service,id',
            'customer_id' => 'required|exists:customer,id',
            'transaction_code' => 'required|string|max:50',
            'payment_date' => 'required|date',
            'payment_method' => 'required|in:cash,credit_card,bank_transfer',
            'amount' => 'required|numeric|min:0',
            'reference_number' => 'nullable|string|max:50',
            'status' => 'required|in:pending,completed,failed',
            'employee_id' => 'required|exists:employee,id',
        ];
    }
}