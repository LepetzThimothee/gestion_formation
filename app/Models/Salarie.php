<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Salarie
 *
 * @property int $matricule
 * @property string $nom
 * @property string|null $nom_jeune_fille
 * @property string $prenom
 * @property string $code_etablissement
 * @property string $sexe
 * @property string $naissance
 * @property int $age
 * @property int $numero_secu
 * @property string $domiciliation_bancaire
 * @property string $iban
 * @property string $bic
 * @property string $email_perso
 * @property string $email_pro
 * @property string $adresse_ligne1
 * @property string $adresse_ligne2
 * @property string $adresse_ligne3
 * @property string $adresse_ligne4
 * @property int $nature_contrat
 * @property int $type_contrat
 * @property string|null $puissance_fiscal
 * @property string $referent_paie
 * @property string $unite
 * @property string $lib_unite
 * @property string $section_analytique
 * @property string $debut_anciennete_groupe
 * @property string $debut_contrat
 * @property string|null $fin_contrat
 * @property string $filiere
 * @property string $sous_filiere
 * @property string $metier
 * @property string $emploi
 * @property string $statut
 * @property string|null $rpps
 * @property string|null $adeli
 * @property string $cpn
 * @property int $taux_emploi
 * @property float $horaire_contrat
 * @property float $montant_aq004
 * @property float $taux_horaire
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Plan> $plans
 * @property-read int|null $plans_count
 * @method static \Database\Factories\SalarieFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie query()
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereAdeli($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereAdresseLigne1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereAdresseLigne2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereAdresseLigne3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereAdresseLigne4($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereAge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereBic($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereCodeEtablissement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereCpn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereDebutAncienneteGroupe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereDebutContrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereDomiciliationBancaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereEmailPerso($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereEmailPro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereEmploi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereFiliere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereFinContrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereHoraireContrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereIban($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereLibUnite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereMatricule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereMetier($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereMontantAq004($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereNaissance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereNatureContrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereNom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereNomJeuneFille($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereNumeroSecu($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie wherePrenom($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie wherePuissanceFiscal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereReferentPaie($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereRpps($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereSectionAnalytique($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereSexe($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereSousFiliere($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereStatut($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereTauxEmploi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereTauxHoraire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereTypeContrat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereUnite($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Salarie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Salarie extends Model
{
    use HasFactory;
    protected $primaryKey = 'matricule';
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

    public function plans()
    {
        return $this->belongsToMany(Plan::class)
            ->using(PlanSalarie::class)
            ->withPivot(['nombre_heures_realisees', 'transport', 'hebergement', 'restauration', 'total']);
    }
}
