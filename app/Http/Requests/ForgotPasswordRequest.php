<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class ForgotPasswordRequest extends FormRequest
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
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'You must specify an email address',
            'email.email' => 'The email must be a valid email address',
        ];
    }

    public function codes(): array
    {
        return [
            'email.required' => 'AUT-0206-0001',
            'email.email' => 'AUT-0206-0002',
        ];
    }
}
