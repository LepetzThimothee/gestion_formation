<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Formation
 *
 * @property int $id
 * @property string|null $organisme
 * @property string|null $telephone
 * @property string|null $email
 * @property string|null $numero_declaration_existence
 * @property int|null $siret
 * @property string|null $adresse
 * @property string|null $interlocuteur
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stage> $stages
 * @property-read int|null $stages_count
 * @method static \Database\Factories\FormationFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|Formation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Formation query()
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereAdresse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereInterlocuteur($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereNumeroDeclarationExistence($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereOrganisme($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereSiret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereTelephone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Formation whereUpdatedAt($value)
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Stage> $stages
 * @mixin \Eloquent
 */
class Formation extends Model
{
    use HasFactory;
    protected $fillable = [
        'organisme',
        'telephone',
        'email',
        'numero_declaration_existence',
        'siret',
        'adresse',
        'interlocuteur',
    ];

    public function stages() {
        return $this->hasMany(Stage::class);
    }
}
