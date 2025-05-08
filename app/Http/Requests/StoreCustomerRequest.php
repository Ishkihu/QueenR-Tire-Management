<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_number' => 'required|string|max:20|unique:customer,customer_number',
            'firstName' => 'required|string|max:50',
            'lastName' => 'required|string|max:50',
            'contact' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
        ];
    }
}