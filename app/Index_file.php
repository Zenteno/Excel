<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Index_file extends Model
{

  protected $table = 'index_files';
  protected $fillable = ['file_name'];

  public function fficha() {
    return $this->hasMany('App\Ficha');
  }
}
