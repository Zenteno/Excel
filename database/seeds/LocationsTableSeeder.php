<?php

use Illuminate\Database\Seeder;
use App\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

      $location1 = new Location();
      $location1->location_name = 'Lugar 1';
      $location1->save();


      $location2 = new Location();
      $location2->location_name = 'Lugar 2';
      $location2->save();


      $location3 = new Location();
      $location3->location_name = 'Lugar 3';
      $location3->save();

      $location4 = new Location();
      $location4->location_name = 'Por asignar';
      $location4->save();
    }
}
