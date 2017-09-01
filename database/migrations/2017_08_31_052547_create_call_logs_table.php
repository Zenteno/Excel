<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCallLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ficha_id')->unsigned();
            $table->integer('callstate_id')->unsigned();
            $table->string('telefono');
            $table->string('comment')->nullable();
            $table->timestamps();

            $table->foreign('ficha_id')->references('id')->on('formularios')->onDelete('set null');
            $table->foreign('callstate_id')->references('id')->on('callstates')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('call_logs');
    }
}
