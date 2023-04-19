<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stage extends Model
{
    use HasFactory;

    protected $fillable = [
        'session',
        'fomation_id',
        'intitule',
        'numero',
        'numero_declaration_existence',
        'organisme',
        'formation_obligatoire',
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
}
