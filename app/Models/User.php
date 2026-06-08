<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
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
        'password' => 'hashed',
    ];

    public function userCmc()
    {
        return $this->hasOne(UserCmc::class);
    }

    public function partenaire()
    {
        return $this->hasOne(Partenaire::class);
    }

    public function isCmc(): bool
    {
        if (!$this->relationLoaded('userCmc')) {
            $this->load('userCmc');
        }
        return (bool) $this->userCmc;
    }

    public function isPartenaire(): bool
    {
        if (!$this->relationLoaded('partenaire')) {
            $this->load('partenaire');
        }
        return (bool) $this->partenaire;
    }
}
