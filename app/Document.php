<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
  protected $fillable = [
      'document', 'receive_id','envoi_id','created_at','update_at'
  ];
}
