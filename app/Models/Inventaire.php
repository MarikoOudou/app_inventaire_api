<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\codification;
use App\Models\PeriodeInventaire;
use App\Models\User;

/**
 * @OA\Schema(
 *     title="Inventaire",
 *     description="",
 *     @OA\Xml(
 *         name="Inventaire"
 *     )
 * )
 */
class Inventaire extends Model
{
    use HasFactory;


    /**
     * @OA\Property(
     *     title="Identifiant"
     * )
     *
     * @var integer
     */
    private $id;

    /**
     * @OA\Property(
     *     title="etat"
     * )
     *
     * @var string
     */
    private $etat;

    /**
     * @OA\Property(
     *     title="Nom agent"
     * )
     *
     * @var string
     */
    private $nom_agent;

    /**
     * @OA\Property(
     *     title="Nom agent"
     * )
     *
     * @var string
     */
    private $observations;

    /**
     * @OA\Property(
     *     title="codification "
     * )
     *
     * @var string
     */
    private $id_codification;

    /**
     * @OA\Property(
     *     title="Identifiant inentaire periode"
     * )
     *
     * @var string
     */
    private $id_periode_inventaire;

    /**
     * @OA\Property(
     *     title="Identifiant user"
     * )
     *
     * @var string
     */
    private $userId;

    protected $fillable = [
        'etat',
        'nom_agent',
        'observations',
        'date_inventaire',
        
        'libelle_localisation',
        'code_localisation',

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
