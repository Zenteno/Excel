<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormularioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('formularios', function (Blueprint $table) {
            $table->increments('id');
            $table->DateTime("fecha");
            $table->string("paciente",100);
            $table->string("medico_nombre")->nullable();
            $table->string("rut",40);
            $table->string("sexo",10);
            $table->string("edad",2);
            $table->string("prestacion",100);
            $table->string("fono1",20)->nullable();
            $table->string("fono2",20)->nullable();
            $table->string("fono3",20)->nullable();
            $table->string("observacion",255)->nullable();
            $table->string("ejecutiva",100)->nullable();
            $table->string("intento1",40)->nullable();
            $table->string("intento2",40)->nullable();
            $table->string("intento3",40)->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('formularios');
    }
}
