<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDeviceTokenRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'token'       => ['required', 'string', 'max:255'],
            'device_type' => ['required', Rule::in(['android', 'ios', 'web'])],
            'device_id'   => ['nullable', 'string', 'max:255'],
        ];
    }
}
