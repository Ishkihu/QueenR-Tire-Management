<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
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
            'customer_id' => 'sometimes|required|exists:customer,id',
            'transaction_code' => 'sometimes|required|string|max:50',
            'payment_date' => 'sometimes|required|date',
            'payment_method' => 'sometimes|required|in:cash,credit_card,bank_transfer',
            'amount' => 'sometimes|required|numeric|min:0',
            'reference_number' => 'nullable|string|max:50',
            'status' => 'sometimes|required|in:pending,completed,failed',
            'employee_id' => 'sometimes|required|exists:employee,id',
        ];
    }
}