<?php

namespace App\Models;

use Barryvdh\LaravelIdeHelper\Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

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
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection<int, Stage> $stages
 * @property-read int|null $stages_count
 * @method static Builder|Formation newModelQuery()
 * @method static Builder|Formation newQuery()
 * @method static Builder|Formation query()
 * @method static Builder|Formation whereAdresse($value)
 * @method static Builder|Formation whereCreatedAt($value)
 * @method static Builder|Formation whereEmail($value)
 * @method static Builder|Formation whereId($value)
 * @method static Builder|Formation whereInterlocuteur($value)
 * @method static Builder|Formation whereNumeroDeclarationExistence($value)
 * @method static Builder|Formation whereOrganisme($value)
 * @method static Builder|Formation whereSiret($value)
 * @method static Builder|Formation whereTelephone($value)
 * @method static Builder|Formation whereUpdatedAt($value)
 * @mixin Eloquent
 */
class Formation extends Model
{
    use HasFactory;

    // Les attributs
    protected $fillable = [
        'organisme',
        'telephone',
        'email',
        'numero_declaration_existence',
        'siret',
        'adresse',
        'interlocuteur',
    ];

    /**
     * Relation avec les stages
     * Une formation peut avoir plusieurs stages
     *
     * @return HasMany
     */
    public function stages(): HasMany
    {
        return $this->hasMany(Stage::class);
    }
}
