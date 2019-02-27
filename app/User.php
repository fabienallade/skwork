<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','poste_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function publications()
    {
      return  $this->hasMany("Publication");
    }
    public function messages()
    {
      return  $this->hasMany("App\Message",'envoi_id');
    }
    public function comments()
    {
      return  $this->hasMany("App\Comment");
    }
    public function postes()
    {
        return  $this->hasOne("App\Poste",'id',"poste_id");
    }

    public function conversation()
    {
        return $this->hasOne("App\Conversation","id");
    }
}
