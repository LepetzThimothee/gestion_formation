<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
 * @property-read \App\Models\Formation|null $formation
 * @method static \Database\Factories\StageFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Stage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Stage query()
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereAttestation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereConvention($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereConvocation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereCoutPedagogique($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereDebutFormation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereDuree($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereFacture($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereFinFormation($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereFormationId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereFormationObligatoire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereIntitule($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereIntraInter($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereOpco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereOrganisme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereSession($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Stage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Stage extends Model
{
    use HasFactory;
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

    public function formation() {
        return $this->belongsTo(Formation::class);
    }

    public function plans()
    {
        return $this->hasMany(Plan::class);
    }
}
