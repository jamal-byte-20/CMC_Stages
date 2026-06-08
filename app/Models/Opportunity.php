<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Opportunity extends Model
{
    protected $fillable = [
        'title',
        'description',
        'secteur',
        'type',
        'niveau',
        'profil_requis',
        'ville',
        'partenaire_id',
    ];

    public function secteur()
    {
        return $this->belongsTo(secteur::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function partenaire()
    {
        return $this->belongsTo(Partenaire::class);
    }

    public function scopeVisibleTo($query, User $user)
    {
        $query->with('partenaire.user');

        if ($user->isCmc()) {
            return $query;
        }

        return $query->where('partenaire_id', $user->partenaire?->id ?? 0);
    }
}
