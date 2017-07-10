<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ficha extends Model
{
	protected $table = 'formularios';
	protected $fillable = ["especialidad","medico","fecha","paciente","rut","sexo","fono1","fono2","fono3","observacion","intento1","intento2","intento3","ejecutiva"];
}
