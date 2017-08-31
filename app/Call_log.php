<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call_log extends Model
{
  protected $table = 'call_logs';
  protected $fillable = ['ficha_id','callstate_id','telefono','comment'];



}
