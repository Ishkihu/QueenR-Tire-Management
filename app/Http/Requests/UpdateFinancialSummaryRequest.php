<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFinancialSummaryRequest extends FormRequest
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
            'period_start_date' => 'sometimes|required|date',
            'period_end_date' => 'sometimes|required|date|after_or_equal:period_start_date',
            'total_revenue' => 'sometimes|required|numeric|min:0',
            'total_expenses' => 'sometimes|required|numeric|min:0',
            'net_profit' => 'sometimes|required|numeric',
            'total_sales' => 'sometimes|required|numeric|min:0',
            'total_services' => 'sometimes|required|numeric|min:0',
            'customer_count' => 'sometimes|required|integer|min:0',
            'generated_by' => 'sometimes|required|exists:employee,id',
        ];
    }
}