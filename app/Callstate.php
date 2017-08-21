<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Callstate extends Model
{
  protected $table = 'callstates';
  protected $fillable = ['estadollamada'];
}
