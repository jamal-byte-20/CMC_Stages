<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
}
