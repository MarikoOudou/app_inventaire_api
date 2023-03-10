<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Ramsey\Uuid\Type\Integer;

/**
 * @OA\Schema(
 *     title="Users",
 *     description="Users model",
 *     @OA\Xml(
 *         name="Project"
 *     )
 * )
 */
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * @OA\Property(
     *     title="ID",
     *     description="ID",
     *     format="int64",
     *     example=1
     * )
     *
     * @var integer
     */
    private Integer $id;

    /**
     * @OA\Property(
     *     title="fullname",
     *     description="fullname",
     * )
     *
     * @var string
     */
    private string $fullname;

    /**
     * @OA\Property(
     *     title="email",
     *     description="email",
     * )
     *
     * @var string
     */
    private string $email;

    /**
     * @OA\Property(
     *     title="type user",
     *     description="type user",
     * )
     *
     * @var string
     */
    private string $type_user;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'email',
        'type_user',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inventaires()
    {
        return $this->hasMany(Inventaire::class);
    }

}
