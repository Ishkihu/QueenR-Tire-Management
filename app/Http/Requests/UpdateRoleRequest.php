<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $roleId = $this->route('role')->id ?? null;

        return [
            'name' => 'sometimes|required|string|max:50|unique:roles,name,' . $roleId,
            'description' => 'nullable|string',
            'access_level' => 'nullable|integer',
        ];
    }
}