<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class MessageRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'content' => ['required', 'string', 'max:1000'],
            'conversation_id' => ['required', 'integer', 'exists:conversations,id'],
            'sender_id' => ['required', 'integer', 'exists:users,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'content.required' => 'Il messaggio non può essere vuoto.',
            'content.string' => 'Il messaggio deve essere una stringa.',
            'content.max' => 'Il messaggio non può superare i 1000 caratteri.',
            'conversation_id.required' => 'La conversazione è obbligatoria.',
            'conversation_id.integer' => 'La conversazione deve essere un numero intero.',
            'conversation_id.exists' => 'La conversazione selezionata non esiste.',
            'sender_id.required' => 'Il mittente è obbligatorio.',
            'sender_id.integer' => 'Il mittente deve essere un numero intero.',
            'sender_id.exists' => 'Il mittente selezionato non esiste.',
        ];
    }
}
