<?php

namespace App\Http\Requests\Projet;

use Illuminate\Foundation\Http\FormRequest;

class ProjetRequest extends FormRequest
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
            'libelle'=>'required|string',
            'client'=>'required|string',
            'date_debut'=>'required|date',
            'date_fin'=>'nullable|string',
            'est_archive'=>'required|boolean',
        ];
    }
}
