<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    protected $fillable = [
        'body', 'url', 'user_id','created_at','photo'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat("Y-m-d H:i:s",$value)->diffForHumans();
    }
    public function user()
    {
      return  $this->belongsTo("App\User");
    }
    public function comments()
    {
      return  $this->hasMany("App\Comment");
    }
}
