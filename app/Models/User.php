<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function notes()
    {
        //um usuario pode ter muitas notas
        return $this->hasMany(Note::class);
    }
}
