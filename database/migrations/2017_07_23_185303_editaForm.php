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

            $table->integer('medico')->unsigned();
            $table->integer('specialty')->unsigned();
            $table->integer('estado')->unsigned();

            $table->foreign('medico')->references('id')->on('doctors');
            $table->foreign('specialty')->references('id')->on('specialties');
            $table->foreign('estado')->references('id')->on('states');
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
