<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatecodificationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            //
            'n_inventaire' ,
            'code_guichet',
            'departement',
            'n_serie',
            'direction',
            'famille',
            'libelle_famille',
            'sous_libelle_famille',
            'niveau',
            'service',
            'sous_famille',
            'code_localisation',
            'libelle_agence',
            'libelle_localisation'
        ];
    }
}
