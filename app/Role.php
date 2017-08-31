<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $table = 'roles';
  protected $fillable = ['nombre_rol','descripcion_rol'];

  public function users()
  {
    return $this
      ->belongsToMany('App\User')
      ->withTimestamps();
    }

}
