<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    //
    protected $fillable = [
        'libelle', 'created_at', 'updated_at'
    ];
}
