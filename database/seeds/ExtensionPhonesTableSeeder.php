<?php

use Illuminate\Database\Seeder;
use App\ExtensionPhone;

class ExtensionPhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i=4000;$i<=4025;$i++){
          $new_anexo        = new ExtensionPhone();
          $new_anexo->anexo = $i;
          $new_anexo->save();
        }
    }
}
