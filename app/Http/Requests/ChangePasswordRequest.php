<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'current_password' => 'required|string',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'current_password.required' => 'You must specify your current password',
            'password.required' => 'You must specify a new password',
            'password.min' => 'The new password must be at least 8 characters',
            'password.confirmed' => 'The password confirmation does not match',
        ];
    }

    public function codes(): array
    {
        return [
            'current_password.required' => 'AUT-0206-0001',
            'password.required' => 'AUT-0206-0002',
            'password.min' => 'AUT-0206-0003',
            'password.confirmed' => 'AUT-0206-0004',
        ];
    }
}
