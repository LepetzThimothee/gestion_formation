<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * App\Models\Stage
 *
 * @property int $id
 * @property string|null $session
 * @property string|null $intitule
 * @property string|null $numero
 * @property int|null $formation_id
 * @property string|null $organisme
 * @property string|null $formation_obligatoire
 * @property string|null $intra_inter
 * @property string|null $cout_pedagogique
 * @property string|null $debut_formation
 * @property string|null $fin_formation
 * @property string|null $duree
 * @property string|null $opco
 * @property string|null $convention
 * @property string|null $convocation
 * @property string|null $attestation
 * @property string|null $facture
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Formation|null $formation
 * @method static Builder|Stage newModelQuery()
 * @method static Builder|Stage newQuery()
 * @method static Builder|Stage query()
 * @method static Builder|Stage whereAttestation($value)
 * @method static Builder|Stage whereConvention($value)
 * @method static Builder|Stage whereConvocation($value)
 * @method static Builder|Stage whereCoutPedagogique($value)
 * @method static Builder|Stage whereCreatedAt($value)
 * @method static Builder|Stage whereDebutFormation($value)
 * @method static Builder|Stage whereDuree($value)
 * @method static Builder|Stage whereFacture($value)
 * @method static Builder|Stage whereFinFormation($value)
 * @method static Builder|Stage whereFormationId($value)
 * @method static Builder|Stage whereFormationObligatoire($value)
 * @method static Builder|Stage whereId($value)
 * @method static Builder|Stage whereIntitule($value)
 * @method static Builder|Stage whereIntraInter($value)
 * @method static Builder|Stage whereNumero($value)
 * @method static Builder|Stage whereOpco($value)
 * @method static Builder|Stage whereOrganisme($value)
 * @method static Builder|Stage whereSession($value)
 * @method static Builder|Stage whereUpdatedAt($value)
 * @property-read Collection<int, Plan> $plans
 * @property-read int|null $plans_count
 * @mixin Eloquent
 */
class Stage extends Model
{
    use HasFactory;

    // Les attributs
    protected $fillable = [
        'session',
        'intitule',
        'numero',
        'formation_id',
        'organisme',
        'formation_obligatoire',
        'intra_inter',
        'cout_pedagogique',
        'debut_formation',
        'fin_formation',
        'duree',
        'opco',
        'convention',
        'convocation',
        'attestation',
        'facture',
    ];

    protected array $dates = [
        'debut_formation',
        'fin_formation',
    ];

    /**
     * Relation avec la formation
     * Un stage appartient à une formation
     *
     * @return BelongsTo
     */
    public function formation(): BelongsTo
    {
        return $this->belongsTo(Formation::class);
    }

    /**
     * Relation avec les plans
     * Un stage peut avoir un seul plan
     *
     * @return HasOne
     */
    public function plans(): HasOne
    {
        return $this->hasOne(Plan::class);
    }
}
