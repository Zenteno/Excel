<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','telefono','rut','fecha_nacimientos','apellidos','anexo_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function specialty(){
        return $this->belongsToMany('\App\Specialty','specialty_user','usuario','especialidad');
    }

    public function roles()
    {
      return $this
        ->belongsToMany('App\Role')
        ->withTimestamps();
      }


      public function authorizeRoles($roles)
      {
        if ($this->hasAnyRole($roles)) {
          return true;
        }
        abort(401, 'Esta acción no esta permitida.');
      }

      public function hasAnyRole($roles)
      {
        if (is_array($roles)) {
          foreach ($roles as $role) {
            if ($this->hasRole($role)) {
              return true;
            }
          }
        } else {
          if ($this->hasRole($roles)) {
            return true;
          }
        }
        return false;
      }

      public function hasRole($role)
      {
        if ($this->roles()->where('nombre_rol', $role)->first()) {
          return true;
        }
        return false;
      }

      public function anexo()
      {
        return $this
          ->belongsTo('App\ExtensionPhone');
      }



}
