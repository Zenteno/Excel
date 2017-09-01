<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Call_log extends Model
{
  protected $table = 'call_logs';
  protected $fillable = ['ficha_id','callstate_id','telefono','comment'];

  public function cficha()
  {
      return $this->belongsTo('App\Ficha','ficha_id');
  }
  public function ccallstate()
  {
      return $this->belongsTo('App\Callstate','callstate_id');
  }

}
