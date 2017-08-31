<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
  protected $table = 'locations';
  protected $fillable = ['location_name'];


  public function fficha() {
      return $this->belongsTo('App\Ficha');
  }

}
