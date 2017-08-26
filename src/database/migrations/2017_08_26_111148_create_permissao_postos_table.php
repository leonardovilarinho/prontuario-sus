<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissaoPostosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissao_postos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('usuario_id')->unsigned();

            $table->foreign('usuario_id')
              ->references('id')
              ->on('usuarios')
            ->onDelete('cascade');

            $table->integer('cabecalho_id')->unsigned();

            $table->foreign('cabecalho_id')
              ->references('id')
              ->on('cabecalhos')
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
        Schema::dropIfExists('permissao_postos');
    }
}
