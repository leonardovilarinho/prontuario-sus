<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReceituariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receituarios', function (Blueprint $table) {
            $table->increments('id');
            $table->text('conteudo');

            $table->integer('paciente_id')->unsigned();

            $table->foreign('paciente_id')
              ->references('id')
              ->on('pacientes')
            ->onDelete('cascade');

            $table->integer('autor_id')->unsigned();

            $table->foreign('autor_id')
              ->references('id')
              ->on('usuarios')
            ->onDelete('cascade');

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
        Schema::dropIfExists('receituarios');
    }
}
