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

    public function scopeSpecialty($query, $esp_name){
  		return $query->whereRaw("MATCH('especialidad')AGAINST('$esp_name' IN BOOLEAN MODE)");
  	}

    public function scopeSearch($query, $q)
    {
   $match = "MATCH('especialidad') AGAINST (?)";
   return $query->whereRaw($match, array($q))
                ->orderByRaw($match.' DESC', array($q));
              }
}
