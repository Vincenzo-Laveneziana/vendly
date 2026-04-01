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
            'description' => ['string'],
            'price' => ['required', 'numeric', 'min:0'],
            'category' => ['integer'],
            'images' => ['array', 'max:5'], // Massimo 5 immagini
            'images.*' => ['file', 'image', 'mimes:jpg,jpeg,png,webpm', 'max:2048'], // Ogni immagine max 2MB
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio.',
            'description.required' => 'La descrizione è obbligatoria.',
            'price.required' => 'Il prezzo è obbligatorio.',
            'category.required' => 'La categoria è obbligatoria.',
            'images.array' => 'Le immagini devono essere un array.',
            'images.max' => 'Puoi caricare al massimo 5 immagini.',
            'images.mimes' => 'Formato non valido. Le immagini devono essere in formato jpg, jpeg, png o webpm.',
            'images.max' => 'Ogni immagine deve essere al massimo di 2MB.',
        ];
    }
}
