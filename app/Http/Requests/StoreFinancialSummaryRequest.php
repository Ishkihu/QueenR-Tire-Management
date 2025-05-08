<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFinancialSummaryRequest extends FormRequest
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
            'period_start_date' => 'required|date',
            'period_end_date' => 'required|date|after_or_equal:period_start_date',
            'total_revenue' => 'required|numeric|min:0',
            'total_expenses' => 'required|numeric|min:0',
            'net_profit' => 'required|numeric',
            'total_sales' => 'required|numeric|min:0',
            'total_services' => 'required|numeric|min:0',
            'customer_count' => 'required|integer|min:0',
            'generated_by' => 'required|exists:employee,id',
        ];
    }
}