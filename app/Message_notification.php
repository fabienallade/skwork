<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message_notification extends Model
{
    protected $fillable = [
        'message_id', 'conversation_id','user_id','is_seen','is_sender','flagged','created_at','update_at','deleted_at'
    ];
    public function sender()
    {
        return $this->belongsTo("App\User", 'user_id');
    }
}
