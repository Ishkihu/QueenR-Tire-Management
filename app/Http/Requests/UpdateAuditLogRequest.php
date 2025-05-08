<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAuditLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'table_name' => 'sometimes|required|string|max:100',
            'record_id' => 'sometimes|required|integer',
            'field_name' => 'nullable|string|max:100',
            'old_value' => 'nullable|string',
            'new_value' => 'nullable|string',
            'action_type' => 'sometimes|required|string|max:50',
            'employee_id' => 'sometimes|required|exists:employee,id',
        ];
    }
}