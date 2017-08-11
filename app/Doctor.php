<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';
    protected $fillable = ['run','nombres','especialidad_id','comentarios'];

    public function specialty()
    {
        return $this->belongsTo('App\Specialty','especialidad_id');
    }
    public static function medicosPorEspecialidad($id){
        return Doctor::select('id','nombres')
                       ->where('especialidad_id',$id)
                       ->get();
    }

}
