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
        return $this->belongsToMany('\App\User','specialty_user')
            ->withPivot('user_id', 'status');
    }
}
