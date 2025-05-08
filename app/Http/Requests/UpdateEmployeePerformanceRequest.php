<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeePerformanceRequest extends FormRequest
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
            'employee_id' => 'sometimes|required|exists:employee,id',
            'period_start_date' => 'sometimes|required|date',
            'period_end_date' => 'sometimes|required|date|after_or_equal:period_start_date',
            'total_sales' => 'sometimes|required|numeric|min:0',
            'total_services' => 'sometimes|required|numeric|min:0',
            'performance_rating' => 'sometimes|required|numeric|min:0|max:10',
        ];
    }
}