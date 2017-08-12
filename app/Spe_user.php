<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spe_user extends Model
{
    protected $table = 'specialty_user';
    protected $fillable = ['status','usuario','especialidad'];


    public static function especialidadesPorUser($id){
      return Spe_user::where('usuario',$id)->get();
    }
}
