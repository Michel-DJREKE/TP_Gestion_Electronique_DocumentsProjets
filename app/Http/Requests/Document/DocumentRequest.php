<?php

namespace App\Http\Requests\Document;

use Illuminate\Foundation\Http\FormRequest;

class DocumentRequest extends FormRequest
{
    
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nom'=>'required|string|min:3',
            'chemin'=>'required|string',
            'date_creation'=>'required|date',
            'auteur'=>'required|string|min:3',
            'date_derniere_modification'=>'nullable|date',
            'dernier_utilisateur_modification'=>'nullable|integer',
            'historique_actions'=>'nullable|string'
        ];
    }
}
