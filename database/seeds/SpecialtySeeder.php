<?php

use Illuminate\Database\Seeder;
use app\Specialty;
use Faker\Factory as Faker;

class SpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $faker = Faker::create();
      for ($i=0; $i < 5; $i++) {
          \DB::table('specialties')->insert(array(
                 'especialidad'  => $faker->randomElement(['Medicina General','Pediatría','Cardiología','Oftalmología','Traumatología']),
                 'created_at' => date('Y-m-d H:m:s'),
                 'updated_at' => date('Y-m-d H:m:s')
          ));
      }
    }
}
