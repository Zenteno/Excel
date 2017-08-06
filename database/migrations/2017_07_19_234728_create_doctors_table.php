<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
       Schema::create('doctors', function (Blueprint $table) {
           $table->increments('id');
           $table->string('run',10)->nullable();
           $table->string('nombres',50);
           $table->integer('especialidad_id')->unsigned();
           $table->string('comentarios',500);
           $table->foreign('especialidad_id')->references('id')->on('specialties')->onDelete('cascade');
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
         Schema::dropIfExists('doctors');
     }
 }
