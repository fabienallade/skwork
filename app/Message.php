<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

  protected $fillable = [
      'messages', 'receiver_id', 'envoi_id','created_at'
  ];
    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat("Y-m-d H:i:s",$value)->diffForHumans();
    }
    public function user()
    {
      return $this->belongsTo("App\User");
    }
}
