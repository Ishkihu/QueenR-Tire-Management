<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSaleRequest extends FormRequest
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
        $saleId = $this->route('sale')->id ?? null;

        return [
            'invoice_number' => 'sometimes|required|string|max:50|unique:sale,invoice_number,' . $saleId,
            'sale_date' => 'sometimes|required|date',
            'subtotal' => 'sometimes|required|numeric|min:0',
            'tax_amount' => 'sometimes|required|numeric|min:0',
            'total_amount' => 'sometimes|required|numeric|min:0',
            'employee_id' => 'sometimes|required|exists:employee,id',
            'customer_id' => 'sometimes|required|exists:customer,id',
        ];
    }
}