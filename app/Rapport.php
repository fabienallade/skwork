<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rapport extends Model
{
    //
    protected $fillable = [
        'name','taches_id','body','certifie'
    ];
}
