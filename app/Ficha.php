<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
	protected $table = 'formularios';
	protected $fillable = ["specialty","medico_nombre","medico","fecha","paciente","rut","sexo","edad","prestacion","fono1","fono2","fono3","observacion","intento1","intento2","intento3","ejecutiva","estado",'location_id',];

	public function doctor(){
        return $this->hasOne('App\Doctor','id','medico');
    }
    public function fespecialidad(){
        return $this->hasOne('App\Specialty','id','specialty');
    }

	public function festado(){
		return $this->hasOne('App\Status','id','estado');
	}

	public static function fichasPorEspecialiad($id){
		return Ficha::where('specialty',$id)->get();
	}

	public function findex_file() {
    return $this->hasOne('App\Index_file');
	}

	public function flocation() {
    return $this->hasOne('App\Location','id','location_id');
	}


	public function fcallstates()
  {
    return $this
      ->belongsToMany('App\callstates')
      ->withTimestamps();
    }

		public function fcall_logs()
	  {
	    return $this
	      ->belongsToMany('App\Call_log')
	      ->withTimestamps();
	    }

}
