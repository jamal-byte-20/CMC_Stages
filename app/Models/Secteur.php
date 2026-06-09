<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Secteur extends Model
{
    protected $fillable = [
        'title',
    ];

    public function opportunities()
    {
        return $this->  
            hasMany(Opportunity::class);
    }
}
