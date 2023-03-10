<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Inventaire;

/**
 * @OA\Schema(
 *     title="codification",
 *     description="Users codification",
 *     @OA\Xml(
 *         name="Codification"
 *     )
 * )
 */
class codification extends Model
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
     *     title="N° inventaire"
     * )
     *
     * @var string
     */
    private $n_inventaire;

    /**
     * @OA\Property(
     *     title="libelle immo"
     * )
     *
     * @var string
     */
    private $libelle_immo;

    /**
     * @OA\Property(
     *     title="libelle localisation"
     * )
     *
     * @var string
     */
    private $libelle_localisation;

    /**
     * @OA\Property(
     *     title="code localisation"
     * )
     *
     * @var string
     */
    private $code_localisation;

    /**
     * @OA\Property(
     *     title="libelle complementaire"
     * )
     *
     * @var string
     */
    private $libelle_complementaire;

    /**
     * @OA\Property(
     *     title="code guichet"
     * )
     *
     * @var string
     */
    private $code_guichet;

    /**
     * @OA\Property(
     *     title="departement"
     * )
     *
     * @var string
     */
    private $departement;

    /**
     * @OA\Property(
     *     title="n° série"
     * )
     *
     * @var string
     */
    private $n_serie;

    /**
     * @OA\Property(
     *     title="direction"
     * )
     *
     * @var string
     */
    private $direction;

    /**
     * @OA\Property(
     *     title="famille"
     * )
     *
     * @var string
     */
    private $famille;

    /**
     * @OA\Property(
     *     title="sous famille"
     * )
     *
     * @var string
     */
    private $sous_famille;

    /**
     * @OA\Property(
     *     title="libelle famille"
     * )
     *
     * @var string
     */
    private $libelle_famille;

    /**
     * @OA\Property(
     *     title="sous libelle famille"
     * )
     *
     * @var string
     */
    private $sous_libelle_famille;

    /**
     * @OA\Property(
     *     title="niveau"
     * )
     *
     * @var string
     */
    private $niveau;

    /**
     * @OA\Property(
     *     title="service"
     * )
     *
     * @var string
     */
    private $service;

    /**
     * @OA\Property(
     *     title="libelle agence"
     * )
     *
     * @var string
     */
    private $libelle_agence;

    protected $fillable = [
        'n_inventaire',
        'libelle_immo',
        'libelle_complementaire',
        'libelle_localisation',
        'code_localisation',

        'code_guichet',
        'departement',
        'n_serie',
        'direction',
        'famille',
        'sous_famille',
        'libelle_famille',
        'sous_libelle_famille',
        'niveau',
        'service',
        'libelle_agence',
    ];

    // private bool $deleted_at;


    public function inventaires()
    {
        return $this->hasMany(Inventaire::class, 'id_codification', 'id');
    }
}
