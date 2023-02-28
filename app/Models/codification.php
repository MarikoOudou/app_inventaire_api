<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventaire;

class codification extends Model
{
    use HasFactory;

    protected $fillable = [
        'n_inventaire',
        'code_guichet',
        'departement',
        'n_serie',
        'direction',
        'famille',
        'libelle_famille',
        'sous_libelle_famille',
        'niveau',
        'service',
        'sous_famille',
        'code_localisation',
        'libelle_agence',
        'libelle_localisation',
    ];

    public function inventaires()
    {
        return $this->hasMany(Inventaire::class, 'id_codification', 'id');
    }
}
