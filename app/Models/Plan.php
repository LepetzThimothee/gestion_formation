<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Plan
 *
 * @property int $id
 * @property int $stage_id
 * @property int $salaire_impute
 * @property int $nombre_stagiaires
 * @property float $cout_pedagogique_stagiaire
 * @property int $stage_annule
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Salarie> $salaries
 * @property-read int|null $salaries_count
 * @property-read Stage|null $stage
 * @method static Builder|Plan newModelQuery()
 * @method static Builder|Plan newQuery()
 * @method static Builder|Plan query()
 * @method static Builder|Plan whereCoutPedagogiqueStagiaire($value)
 * @method static Builder|Plan whereCreatedAt($value)
 * @method static Builder|Plan whereId($value)
 * @method static Builder|Plan whereNombreStagiaires($value)
 * @method static Builder|Plan whereSalaireImpute($value)
 * @method static Builder|Plan whereStageAnnule($value)
 * @method static Builder|Plan whereStageId($value)
 * @method static Builder|Plan whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Plan extends Model
{
    use HasFactory;

    // Les attributs
    protected $fillable = [
        'stage_id',
        'salaire_impute',
        'nombre_stagiaires',
        'cout_pedagogique_stagiaire',
        'stage_annule',
    ];

    /**
     * Relation avec le stage
     * Un plan appartient à un stage
     *
     * @return BelongsTo
     */
    public function stage(): BelongsTo {
        return $this->belongsTo(Stage::class);
    }

    /**
     * Relation avec les salariés
     * Un plan peut être lié à plusieurs salariés
     *
     * @return BelongsToMany
     */
    public function salaries(): BelongsToMany
    {
        return $this->belongsToMany(Salarie::class)
            ->using(PlanSalarie::class)
            ->withPivot(['nombre_heures_realisees', 'transport', 'hebergement', 'restauration', 'total']);
    }
}
