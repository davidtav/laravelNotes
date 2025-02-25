<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    public function user()
    {
        //muitas notas pertencem a um usuario
        return $this->belongsTo(User::class);
    }
}
