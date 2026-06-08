<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserCmc extends Model
{
    protected $fillable = [
        'post',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
