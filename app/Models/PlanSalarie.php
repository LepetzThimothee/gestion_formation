<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Carbon;

/**
 * App\Models\PlanSalarie
 *
 * @property int $id
 * @property int $plan_id
 * @property int $matricule
 * @property string|null $nombre_heures_realisees
 * @property string|null $transport
 * @property string|null $hebergement
 * @property string|null $restauration
 * @property string|null $total
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Plan $plan
 * @property-read Salarie|null $salarie
 * @method static Builder|PlanSalarie newModelQuery()
 * @method static Builder|PlanSalarie newQuery()
 * @method static Builder|PlanSalarie query()
 * @method static Builder|PlanSalarie whereCreatedAt($value)
 * @method static Builder|PlanSalarie whereHebergement($value)
 * @method static Builder|PlanSalarie whereId($value)
 * @method static Builder|PlanSalarie whereMatricule($value)
 * @method static Builder|PlanSalarie whereNombreHeuresRealisees($value)
 * @method static Builder|PlanSalarie wherePlanId($value)
 * @method static Builder|PlanSalarie whereRestauration($value)
 * @method static Builder|PlanSalarie whereTotal($value)
 * @method static Builder|PlanSalarie whereTransport($value)
 * @method static Builder|PlanSalarie whereUpdatedAt($value)
 * @property int $salarie_matricule
 * @method static Builder|PlanSalarie whereSalarieMatricule($value)
 * @mixin Eloquent
 */
class PlanSalarie extends Pivot
{
    use HasFactory;

    public $timestamps = false;

    // Les attributs
    protected $fillable = [
        'plan_id',
        'salarie_matricule',
        'nombre_heures_realisees',
        'transport',
        'hebergement',
        'restauration',
        'total'
    ];

    /**
     * Relation avec le plan
     * Définit la relation inverse du pivot PlanSalarie vers un Plan
     *
     * @return BelongsTo
     */
    public function plan(): BelongsTo
    {
        return $this->belongsTo(Plan::class);
    }

    /**
     * Relation avec le salarié
     * Définit la relation inverse du pivot PlanSalarie vers un Salarie
     *
     * @return BelongsTo
     */
    public function salarie(): BelongsTo
    {
        return $this->belongsTo(Salarie::class, 'salarie_matricule', 'matricule');
    }
}
