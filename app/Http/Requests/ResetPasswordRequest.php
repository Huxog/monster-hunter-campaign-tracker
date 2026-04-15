<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'token' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'token.required' => 'A reset token is required',
            'email.required' => 'You must specify an email address',
            'email.email' => 'The email must be a valid email address',
            'password.required' => 'You must specify a password',
            'password.min' => 'The password must be at least 8 characters',
            'password.confirmed' => 'The password confirmation does not match',
        ];
    }

    public function codes(): array
    {
        return [
            'token.required' => 'AUT-0206-0001',
            'email.required' => 'AUT-0206-0002',
            'email.email' => 'AUT-0206-0003',
            'password.required' => 'AUT-0206-0004',
            'password.min' => 'AUT-0206-0005',
            'password.confirmed' => 'AUT-0206-0006',
        ];
    }
}
