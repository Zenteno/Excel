<?php

use Illuminate\Database\Seeder;
use App\Status;


class StatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $estado1              = new Status();
      $estado1->estado      = 'Por Asignar';
      $estado1->descripcion = 'Estado por defecto';
      $estado1->save();

      $estado2              = new Status();
      $estado2->estado      = 'Asignado';
      $estado2->descripcion = ' ';
      $estado2->save();

      $estado3              = new Status();
      $estado3->estado      = 'En proceso';
      $estado3->descripcion = ' ';
      $estado3->save();

      $estado4              = new Status();
      $estado4->estado      = 'Finalizado';
      $estado4->descripcion = ' ';
      $estado4->save();

      $estado5              = new Status();
      $estado5->estado      = 'Devuelto con reparo';
      $estado5->descripcion = ' ';
      $estado5->save();

    }
}
