<?php

namespace App;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

  protected $fillable = [
      'body', 'conversation_id', 'user_id','type','created_at'
  ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::createFromFormat("Y-m-d H:i:s",$value)->diffForHumans();
    }
    public function sender()
    {
        return $this->belongsTo("App\User", 'user_id');
    }
    public function conversation()
    {
        return $this->belongsTo("App\Conversation", 'conversation_id');
    }
}
