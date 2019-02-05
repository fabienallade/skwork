<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = [
        'body', 'url', 'user_id','created_at'
    ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat("Y-m-d H:i:s",$value)->diffForHumans();
    }
    public function comments()
    {
      return  $this->belongsTo("App\Publication");
    }
    public function user()
    {
      return  $this->belongsTo("App\User");
    }
}
