<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormationRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'organisme' => "required|string",
            'telephone' => "nullable|string",
            'email' => "nullable|email",
            'numero_declaration_existence' => "nullable|string",
            'siret' => "nullable|integer",
            'adresse' => "nullable|string",
            'interlocuteur' => "nullable|string"
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'organisme.required' => "Entrer le nom de l'organisme de formation.",
            'email.email' => 'Entrer une adresse email valide.',
            'siret.integer' => 'Entrer un numero de siret valide.',
        ];
    }
}
