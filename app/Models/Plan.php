<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = [
        'session',
        'matricule',
        'salaire_impute',
        'nombre_heures_realisees',
        'nombre_stagiaires',
        'cout_pedagogique_stagiaire',
        'transport',
        'hebergement',
        'restauration',
        'total',
        'stage_annule',
    ];

    public function stage() {
        return $this->hasOne(Stage::class);
    }

    public function salaries() {
        return $this->hasMany(Salarie::class);
    }
}
