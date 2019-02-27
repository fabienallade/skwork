<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Conversation_user extends Model
{
    protected $fillable = [
        'user_id', 'conversation_id','created_at','update_at'
    ];

    public function conversation()
    {
        return $this->belongsTo("App\Conversation", 'conversation_id');
    }
}
