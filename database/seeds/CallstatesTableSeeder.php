<?php

use Illuminate\Database\Seeder;
use App\Callstate;
class CallstatesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $call_state1 = new Callstate();
      $call_state1 ->estadollamada = 'número erróneo';
      $call_state1 ->save();

      $call_state2 = new Callstate();
      $call_state2 ->estadollamada = 'buzón de voz';
      $call_state2 ->save();

      $call_state3 = new Callstate();
      $call_state3 ->estadollamada = 'confirmado';
      $call_state3 ->save();

      $call_state4 = new Callstate();
      $call_state4 ->estadollamada = 'ocupado';
      $call_state4 ->save();

      $call_state5 = new Callstate();
      $call_state5->estadollamada = 'rechazado';
      $call_state5->save();

      $call_state6 = new Callstate();
      $call_state6->estadollamada = 'anulado';
      $call_state6->save();

      $call_state7 = new Callstate();
      $call_state7->estadollamada = 'no contesta';
      $call_state7->save();
    }
}
