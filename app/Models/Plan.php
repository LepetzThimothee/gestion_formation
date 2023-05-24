<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Plan
 *
 * @property int $id
 * @property int $stage_id
 * @property int $salaire_impute
 * @property int $nombre_stagiaires
 * @property float $cout_pedagogique_stagiaire
 * @property int $stage_annule
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Salarie> $salaries
 * @property-read int|null $salaries_count
 * @property-read \App\Models\Stage|null $stage
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan query()
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCoutPedagogiqueStagiaire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereNombreStagiaires($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereSalaireImpute($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereStageAnnule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereStageId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Plan whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'stage_id',
        'salaire_impute',
        'nombre_stagiaires',
        'cout_pedagogique_stagiaire',
        'stage_annule',
    ];

    public function stage() {
        return $this->belongsTo(Stage::class);
    }

    public function salaries()
    {
        return $this->belongsToMany(Salarie::class)
            ->using(PlanSalarie::class)
            ->withPivot(['nombre_heures_realisees', 'transport', 'hebergement', 'restauration', 'total']);
    }
}
