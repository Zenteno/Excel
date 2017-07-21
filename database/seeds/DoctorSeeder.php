<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use app\Doctor;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      for ($i=0; $i < 15; $i++) {
        \DB::table('doctors')->insert(array(
         'run'     => $faker->randomElement(['12345678-9','98765432-1','13456967-8','6680294-1','94843220-5','19203493-2','21234156-7']),
         'nombres' => $faker->firstName,
         'paterno'  => $faker->lastName,
         'materno' => $faker->randomElement(['Torres','Zenteno','Cisterna','Jara','Benismelis','Candia','Verdugo','vergara']),
         'especialidad_id' => $faker->numberBetween($min = 1, $max = 5),
         'comentarios' => $faker->sentence(6,true),
         'created_at' => date('Y-m-d H:m:s'),
         'updated_at' => date('Y-m-d H:m:s')
       ));
     }
    }
}
