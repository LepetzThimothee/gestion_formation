<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

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
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Plan $plan
 * @property-read \App\Models\Salarie|null $salarie
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie query()
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereHebergement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereMatricule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereNombreHeuresRealisees($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie wherePlanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereRestauration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereTransport($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PlanSalarie whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PlanSalarie extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'matricule',
        'nombre_heures_realisees',
        'transport',
        'hebergement',
        'restauration',
        'total'
    ];

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    public function salarie()
    {
        return $this->belongsTo(Salarie::class, 'salarie_matricule');
    }
}
