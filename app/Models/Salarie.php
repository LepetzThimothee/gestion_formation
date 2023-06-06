<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Plan> $plans
 * @property-read int|null $plans_count
 * @method static Builder|Salarie newModelQuery()
 * @method static Builder|Salarie newQuery()
 * @method static Builder|Salarie query()
 * @method static Builder|Salarie whereAdeli($value)
 * @method static Builder|Salarie whereAdresseLigne1($value)
 * @method static Builder|Salarie whereAdresseLigne2($value)
 * @method static Builder|Salarie whereAdresseLigne3($value)
 * @method static Builder|Salarie whereAdresseLigne4($value)
 * @method static Builder|Salarie whereAge($value)
 * @method static Builder|Salarie whereBic($value)
 * @method static Builder|Salarie whereCodeEtablissement($value)
 * @method static Builder|Salarie whereCpn($value)
 * @method static Builder|Salarie whereCreatedAt($value)
 * @method static Builder|Salarie whereDebutAncienneteGroupe($value)
 * @method static Builder|Salarie whereDebutContrat($value)
 * @method static Builder|Salarie whereDomiciliationBancaire($value)
 * @method static Builder|Salarie whereEmailPerso($value)
 * @method static Builder|Salarie whereEmailPro($value)
 * @method static Builder|Salarie whereEmploi($value)
 * @method static Builder|Salarie whereFiliere($value)
 * @method static Builder|Salarie whereFinContrat($value)
 * @method static Builder|Salarie whereHoraireContrat($value)
 * @method static Builder|Salarie whereIban($value)
 * @method static Builder|Salarie whereLibUnite($value)
 * @method static Builder|Salarie whereMatricule($value)
 * @method static Builder|Salarie whereMetier($value)
 * @method static Builder|Salarie whereMontantAq004($value)
 * @method static Builder|Salarie whereNaissance($value)
 * @method static Builder|Salarie whereNatureContrat($value)
 * @method static Builder|Salarie whereNom($value)
 * @method static Builder|Salarie whereNomJeuneFille($value)
 * @method static Builder|Salarie whereNumeroSecu($value)
 * @method static Builder|Salarie wherePrenom($value)
 * @method static Builder|Salarie wherePuissanceFiscal($value)
 * @method static Builder|Salarie whereReferentPaie($value)
 * @method static Builder|Salarie whereRpps($value)
 * @method static Builder|Salarie whereSectionAnalytique($value)
 * @method static Builder|Salarie whereSexe($value)
 * @method static Builder|Salarie whereSousFiliere($value)
 * @method static Builder|Salarie whereStatut($value)
 * @method static Builder|Salarie whereTauxEmploi($value)
 * @method static Builder|Salarie whereTauxHoraire($value)
 * @method static Builder|Salarie whereTypeContrat($value)
 * @method static Builder|Salarie whereUnite($value)
 * @method static Builder|Salarie whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Salarie extends Model
{
    use HasFactory;
    protected $primaryKey = 'matricule';

    // Les attributs
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

    /**
     * Relation avec les plans
     * Un salarié peut être lié à plusieurs plans
     *
     * @return BelongsToMany
     */
    public function plans(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'plan_salarie', 'salarie_matricule', 'plan_id')
            ->using(PlanSalarie::class)
            ->withPivot(['nombre_heures_realisees', 'transport', 'hebergement', 'restauration', 'total']);
    }
}
