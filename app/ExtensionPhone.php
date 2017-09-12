<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtensionPhone extends Model
{
    protected $table='extension_phones';
    protected $fillable = ['anexo'];


    public function euser(){
      return $this
        ->hasOne('App\User');
    }
}
