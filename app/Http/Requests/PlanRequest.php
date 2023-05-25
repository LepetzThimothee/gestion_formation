<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
{
    /**
     * Détermine si l'utilisateur est autorisé à effectuer cette demande.
     *
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Obtenez les règles de validation qui s'appliquent à la demande.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'session' => 'required|integer',
            'matricule.*' => 'required',
            'transport.*' => 'required|numeric',
            'hebergement.*' => 'required|numeric',
            'restauration.*' => 'required|numeric',
            'nombre_heures_realisees.*' => 'required|integer',
            'nombre_stagiaires' => 'required|integer'
        ];
    }

    /**
     * Obtenez le message d'erreur pour la rècle de validation défini.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'required' => 'Le champ :attribute est obligatoire.',
            'integer' => 'Le :attribute doit être un nombre',
            'numeric' => 'Le champ :attribute doit être un nombre'
        ];
    }
}
