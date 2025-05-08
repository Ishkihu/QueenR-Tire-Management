<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'scheduled_date' => 'required|date',
            'estimated_duration' => 'required|integer|min:1',
            'assigned_employee_id' => 'required|exists:employee,id',
            'customer_id' => 'required|exists:customer,id',
            'vehicle_id' => 'required|exists:vehicle,id',
            'status' => 'required|in:scheduled,in-progress,completed',
        ];
    }
}