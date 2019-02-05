<?php

namespace App;
use App\Events\BloadcastChat;

use Illuminate\Database\Eloquent\Model;

class Tache extends Model
{
    //
    protected $dispatchesEvent=[
      'created'=>BroadcastChat::class
    ];
    protected $fillable = [
        'name','users_id','do_it','create_at','date'
    ];
}
