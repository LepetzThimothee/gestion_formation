<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
