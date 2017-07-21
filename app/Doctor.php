<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table = 'doctors';
    protected $fillable = ['run','nombres','paterno','materno','especialidad_id','comentarios'];

    public function specialty()
    {
        return $this->belongsTo('App\Specialty','especialidad_id');
    }

}
