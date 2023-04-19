<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salarie extends Model
{
    use HasFactory;

    protected $fillable = [
        'matricule',
        'nom',
        'nom_jeune_fille',
        'prenom',
        'code_etablissement',
        'sexe',
        'naissance',
        'age',
        'numero_secu',
        'domiciliation_bancaire',
        'iban',
        'bic',
        'email_perso',
        'email_pro',
        'adresse_ligne1',
        'adresse_ligne2',
        'adresse_ligne3',
        'adresse_ligne4',
        'nature_contrat',
        'type_contrat',
        'puissance_fiscal',
        'referent_paie',
        'unite',
        'lib_unite',
        'section_analytique',
        'debut_anciennete_groupe',
        'debut_contrat',
        'fin_contrat',
        'filiere',
        'sous_filiere',
        'metier',
        'emploi',
        'statut',
        'rpps',
        'adeli',
        'cpn',
        'taux_emploi',
        'horaire_contrat',
        'montant_aq004',
        'taux_horaire',
    ];
}
