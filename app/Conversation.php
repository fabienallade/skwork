<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $fillable = [
        'private', 'data','created_at','update_at'
    ];

    public function conversation_user()
    {
        return $this->hasMany("App\Conversation_user","id");
    }
    public function users()
    {
        return $this->belongsToMany('App\User', 'conversation_users', 'conversation_id', 'user_id')->withTimestamps();
    }
    public function last_message()
    {
        return $this->hasOne("App\Message")->orderBy('messages.id', 'desc')->with('sender');
    }
    public function messages()
    {
        return $this->hasMany("App\Message", 'conversation_id')->with('sender');
    }

}
