<?php

namespace App\Http\Requests;

use App\Traits\FormatValidationFailure;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    use FormatValidationFailure;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'You must specify a name',
            'name.string' => 'The name must be a string',
            'name.max' => 'The name must not exceed 255 characters',
            'email.required' => 'You must specify an email address',
            'email.email' => 'The email must be a valid email address',
            'email.unique' => 'This email is already registered',
            'password.required' => 'You must specify a password',
            'password.min' => 'The password must be at least 8 characters',
            'password.confirmed' => 'The password confirmation does not match',
        ];
    }

    public function codes(): array
    {
        return [
            'name.required' => 'AUT-0202-0001',
            'name.string' => 'AUT-0202-0002',
            'name.max' => 'AUT-0202-0003',
            'email.required' => 'AUT-0202-0004',
            'email.email' => 'AUT-0202-0005',
            'email.unique' => 'AUT-0202-0006',
            'password.required' => 'AUT-0202-0007',
            'password.min' => 'AUT-0202-0008',
            'password.confirmed' => 'AUT-0202-0009',
        ];
    }
}
