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
            $table->string("especialidad",40);
            $table->string("medico",40);
            $table->dateTime("fecha");
            $table->string("paciente",100);
            $table->string("rut",40);
            $table->string("sexo",10);
            $table->string("fono1",40)->nullable();
            $table->string("fono2",40)->nullable();
            $table->string("fono3",40)->nullable();
            $table->string("observacion",255)->nullable();
            $table->string("intento1",40)->nullable();
            $table->string("intento2",40)->nullable();
            $table->string("intento3",40)->nullable();
            $table->string("ejecutiva",100);
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
