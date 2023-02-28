<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeInventaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'libelle',
        'n_bordereau',
        'isActive',
        'date_debut',
        'date_fin'
    ];

    public function inventaires()
    {
        return $this->hasMany(Inventaire::class);
    }
}
