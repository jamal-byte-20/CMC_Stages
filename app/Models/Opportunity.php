<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opportunity extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'title',
        'description',
        'secteur_id',
        'type_id',
        'niveau',
        'profil_requis',
        'ville',
    ];

    public function secteur()
    {
        return $this->belongsTo(secteur::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
