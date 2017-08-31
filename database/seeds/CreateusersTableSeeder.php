<?php

use Illuminate\Database\Seeder;
use App\User;

class CreateusersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin  = Role::where('nombre_rol','Administrador')->first();

        $manager = new User();
        $manager->name = 'Administrador';
        $manager->email = 'sulloa@kropsys.cl';
        $manager->password = bcrypt(‘Admin123’);
        $manager->save();
        $manager->roles()->attach($role_admin);
    }
}
