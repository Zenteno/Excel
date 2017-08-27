<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
	protected $table = 'formularios';
	protected $fillable = ["specialty","medico","fecha","paciente","rut","sexo","edad","prestacion","fono1","fono2","fono3","observacion","intento1","intento2","intento3","ejecutiva","estado"];

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

}
