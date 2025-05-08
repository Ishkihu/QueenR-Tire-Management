<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceLogRequest extends FormRequest
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
            'service_id' => 'sometimes|required|exists:service,id',
            'timestamp' => 'sometimes|required|date',
            'activity_type' => 'sometimes|required|string|max:100',
            'notes' => 'nullable|string',
            'parts_used' => 'nullable|string',
            'employee_id' => 'sometimes|required|exists:employee,id',
        ];
    }
}