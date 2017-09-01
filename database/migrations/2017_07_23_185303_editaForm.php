<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class EditaForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('formularios', function (Blueprint $table) {

            $table->integer('medico')->unsigned()->nullable();
            $table->integer('specialty')->unsigned();
            $table->integer('estado')->unsigned();
            $table->integer('location_id')->unsigned()->nullable();;
            $table->integer('index_id')->unsigned()->nullable();;

            $table->foreign('medico')->references('id')->on('doctors')->onDelete('cascade');
            $table->foreign('specialty')->references('id')->on('specialties')->onDelete('cascade');
            $table->foreign('estado')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('index_id')->references('id')->on('index_files')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
