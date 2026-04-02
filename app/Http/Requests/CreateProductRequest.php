<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string','max:1000', 'nullable'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['integer','nullable'],
            'images' => ['array', 'max:5'], // Massimo 5 immagini
            'images.*' => ['file', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8144'], // Ogni immagine max 2MB
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'title.string' => 'Il titolo deve essere una stringa.',
            'title.max' => 'Il titolo non può superare i 255 caratteri.',
            'description.string' => 'La descrizione deve essere una stringa.',
            'price.required' => 'Il prezzo è obbligatorio.',
            'price.numeric' => 'Il prezzo deve essere un numero.',
            'price.min' => 'Il prezzo deve essere almeno 0.',
            'images.array' => 'Le immagini devono essere un array.',
            'images.max' => 'Puoi caricare al massimo 5 immagini.',
            'images.*.mimes' => 'Formato non valido. Le immagini devono essere in formato jpg, jpeg, png o webpm.',
            'images.*.max' => 'Ogni immagine deve essere al massimo di 8MB.',
            'images.*.file' => 'Ogni immagine deve essere un file valido.',
            'images.*.uploaded' => 'C\'è stato un errore durante l\'upload dell\'immagine.',
        ];
    }
}
