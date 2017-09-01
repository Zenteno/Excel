<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialty extends Model
{
    protected $table = 'specialties';
    protected $fillable = ['especialidad'];

    public function doctor(){
        return $this->hasMany('app\Doctor');
    }

    public function user(){
    	return $this->belongsToMany(
            'App\User', 'specialty_user',
            'especialidad', 'usuario'
        );
    }


    public function buildConsulta($query, $q)
    {

      $sql = $q[0].".'%')";
      for ($i=1; $i <count($q) ; $i++) {
          $sql = $sql."->where('especialidad','like', '%'.".$q[$i].".'%')" ;
      }
      $sql=$sql.";";
      return $sql;
    }
}
