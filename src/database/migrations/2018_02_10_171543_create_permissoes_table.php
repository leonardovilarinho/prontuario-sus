<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissoesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissoes', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('medico_id')->unsigned();

            $table->foreign('medico_id')
              ->references('id')
              ->on('usuarios')
            ->onDelete('cascade');

            $table->integer('sec_id')->unsigned();

            $table->foreign('sec_id')
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
        Schema::dropIfExists('permissoes');
    }
}
