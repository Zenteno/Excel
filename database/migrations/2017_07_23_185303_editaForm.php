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
            $table->integer('estado')->unsigned()->nullable();
            $table->integer('location_id')->unsigned()->nullable();
            $table->integer('index_id')->unsigned()->nullable();

            $table->foreign('medico')->references('id')->on('doctors');
            $table->foreign('specialty')->references('id')->on('specialties');
            $table->foreign('estado')->references('id')->on('states')->onDelete('set null');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('set null');
            $table->foreign('index_id')->references('id')->on('index_files')->onDelete('set null');
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
