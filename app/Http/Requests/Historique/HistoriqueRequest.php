<?php

namespace App\Http\Requests\Historique;

use Illuminate\Foundation\Http\FormRequest;

class HistoriqueRequest extends FormRequest
{
    public mixed $user_id;

    
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
            'historique_id' => 'required|exists:historique,id',
        ];
    }
}
