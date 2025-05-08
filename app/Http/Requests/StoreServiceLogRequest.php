<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceLogRequest extends FormRequest
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
            'service_id' => 'required|exists:service,id',
            'timestamp' => 'required|date',
            'activity_type' => 'required|string|max:100',
            'notes' => 'nullable|string',
            'parts_used' => 'nullable|string',
            'employee_id' => 'required|exists:employee,id',
        ];
    }
}