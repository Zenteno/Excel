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
}
