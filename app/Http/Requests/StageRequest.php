<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StageRequest extends FormRequest
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
            'session' => "required|integer",
            'intitule' => "required|string",
            'numero' => "nullable|string",
            'formation_id' => "integer",
            'organisme' => "required|string",
            'formation_obligatoire' => "string|min:1|max:1",
            'intra_inter' => "string|min:1|max:1",
            'cout_pedagogique' => "required|numeric",
            'debut_formation' => "date",
            'fin_formation' => "nullable|date",
            'duree' => "integer",
            'opco' => "string|min:1|max:1",
            'convention' => "string|min:1|max:1",
            'convocation' => "string|min:1|max:1",
            'attestation' => "string|min:1|max:1",
            'facture' => "string|min:1|max:1",
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
            'session.required' => "Entrer le numero de session du stage.",
            'intitule.required' => "Entrer l'intitule du stage.",
            'organisme.required' => "Entrer l'organisme de formation.",
            'cout_pedagogique.required' => "Entrer le cout pedagoqique du stage",
            'debut_formation.date' => "Entrer une date valide",
            'fin_formation.date' => "Entrer une date valide",
            'duree.integer' => "Entrer une duree valide"
        ];
    }
}
