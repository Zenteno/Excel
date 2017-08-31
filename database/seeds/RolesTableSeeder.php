<?php

use Illuminate\Database\Seeder;
use App\Role;
class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $role_name1 = new Role();
      $role_name1->nombre_rol = 'Administrador';
      $role_name1->descripcion_rol = 'Rol de administración general';
      $role_name1->save();

      $role_name2 = new Role();
      $role_name2->nombre_rol = 'Ejecutivo';
      $role_name2->descripcion_rol = 'Ejecutivo a cargo de fichas';
      $role_name2->save();

      $role_name3 = new Role();
      $role_name3->nombre_rol = 'Supervisor';
      $role_name3->descripcion_rol = 'Rol de supervisión general';
      $role_name3->save();
    }
}
