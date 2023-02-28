<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\codification;
use App\Models\PeriodeInventaire;
use App\Models\User;

class Inventaire extends Model
{
    use HasFactory;

    protected $fillable = [
        'etat',
        'nom_agent',
        'observations',
        'date_inventaire',
        'id_codification',
        'id_periode_inventaire',
        'userId'
    ];

    public function codification()
    {
        return $this->belongsTo(codification::class, 'id_codification');
    }

    public function periodeInventtaire()
    {
        return $this->belongsTo(PeriodeInventaire::class, 'id_periode_inventaire');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'userId');
    }

}
