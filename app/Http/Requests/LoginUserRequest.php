<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => 'required|string|email|max:40',
            'password' => 'required|string|min:8',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required' => 'L\'email è obbligatoria.',
            'email.email' => 'L\'email deve essere un indirizzo email valido.',
            'email.max' => 'L\'email è troppo lunga.',
            'password.required' => 'La password è obbligatoria.',
            'password.min' => 'La password non è valida.',
        ];
    }
}
