<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|string|email',
            'password' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'You must specify an email address',
            'email.email' => 'The email must be a valid email address',
            'password.required' => 'You must specify a password',
        ];
    }

    public function codes(): array
    {
        return [
            'email.required' => 'AUT-0202-0001',
            'email.email' => 'AUT-0202-0002',
            'password.required' => 'AUT-0202-0003',
        ];
    }
}
