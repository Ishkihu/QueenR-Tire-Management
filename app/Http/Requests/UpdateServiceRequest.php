<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'sometimes|required|numeric|min:0',
            'scheduled_date' => 'sometimes|required|date',
            'estimated_duration' => 'sometimes|required|integer|min:1',
            'assigned_employee_id' => 'sometimes|required|exists:employee,id',
            'customer_id' => 'sometimes|required|exists:customer,id',
            'vehicle_id' => 'sometimes|required|exists:vehicle,id',
            'status' => 'sometimes|required|in:scheduled,in-progress,completed',
        ];
    }
}