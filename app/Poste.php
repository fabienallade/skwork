<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Poste extends Model
{
    //
    protected $fillable = [
        'libelle', 'created_at', 'updated_at','id'
    ];
    public function user()
    {
        return  $this->belongsTo("App\User","poste_id");
    }
}
