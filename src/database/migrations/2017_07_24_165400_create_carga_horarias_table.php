<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargaHorariasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carga_horarias', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('intervalo');
            $table->time('inicio');
            $table->time('fim');

            $table->integer('medico_id')->unsigned()->unique();

            $table->foreign('medico_id')
              ->references('id')
              ->on('usuarios')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carga_horarias');
    }
}
