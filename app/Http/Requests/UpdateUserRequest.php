<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $userId = $this->route('user'); // Assuming the route parameter is named 'user'
            return [
                'name' => 'required|string|max:30',
                'surname' => 'required|string|max:30',
                'date_of_birth' => 'date|before:today|nullable',
                'address.street' => 'string|max:100',
                'address.city' => 'string|max:50',
                'address.zip_code' => 'string|max:20',
                'phone'    => [
                    'unique:users,phone,' . $userId,
                    'nullable', 
                    'string', 
                    'min:9',
                    'max:15',
                    'regex:/^\\+?[1-9][0-9]{7,14}$/'
                ],
                'email' => 'required|string|email|max:255|unique:users,email,' . $userId,
                'password' => 'nullable|string|min:8|confirmed',
            ];
        }
        return [
            'name' => 'required|string|max:30',
            'surname' => 'required|string|max:30',
            'date_of_birth' => 'date|before:today|nullable',
            'address.street' => 'string|max:100',
            'address.city' => 'string|max:50',
            'address.zip_code' => 'string|max:20',
            'phone'    => [
                'unique:users',
                'nullable', 
                'string', 
                'min:9',
                'max:15',
                'regex:/^\\+?[1-9][0-9]{7,14}$/'
            ],
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Il nome è obbligatorio.',
            'name.string' => 'Il nome deve essere un testo valido.',
            'name.max' => 'Il nome deve essere un testo valido.',
            'surname.required' => 'Il cognome è obbligatorio.',
            'surname.string' => 'Il cognome deve essere un testo valido.',
            'surname.max' => 'Il cognome deve essere un testo valido.',
            'address.json' => 'L\'indirizzo deve essere valido.',
            'address.street.string' => 'La via deve essere un testo valido.',
            'address.street.max' => 'La via deve essere un testo valido.',
            'address.city.string' => 'La città deve essere un testo valido.',
            'address.city.max' => 'La città deve essere un testo valido.',
            'address.zip_code.string' => 'Il CAP deve essere un testo valido.',
            'address.zip_code.max' => 'Il CAP deve essere un testo valido.',
            'email.required' => 'L\'email è obbligatoria.',
            'email.email' => 'L\'email deve essere un indirizzo email valido.',
            'email.unique' => 'L\'email è già in uso.',
            'email.max' => 'L\'email nè troppo lunga',
            'phone.unique' => 'Il numero di telefono è già in uso.',
            'phone.string' => 'Il numero di telefono deve essere un testo valido.',
            'phone.min' => 'Il numero di telefono deve essere almeno di 9 caratteri.',
            'phone.max' => 'Il numero di telefono non può superare i 15 caratteri.',
            'phone.regex' => 'Il numero di telefono deve essere un formato valido.',
            'password.required' => 'La password è obbligatoria.',
            'password.min' => 'La password deve essere almeno di 8 caratteri.',
            'password.confirmed' => 'La conferma della password non corrisponde.',
        ];
    }
}
