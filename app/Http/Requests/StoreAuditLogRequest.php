<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAuditLogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'table_name' => 'required|string|max:100',
            'record_id' => 'required|integer',
            'field_name' => 'nullable|string|max:100',
            'old_value' => 'nullable|string',
            'new_value' => 'nullable|string',
            'action_type' => 'required|string|max:50',
            'employee_id' => 'required|exists:employee,id',
        ];
    }
}