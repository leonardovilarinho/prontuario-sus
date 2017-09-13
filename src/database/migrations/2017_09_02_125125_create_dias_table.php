<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medico_id')->unsigned()->nullable();

            $table->foreign('medico_id')
              ->references('id')
              ->on('usuarios')
            ->onDelete('set null');

            $table->tinyInteger('domingo')->default('0');
            $table->tinyInteger('segunda')->default('0');
            $table->tinyInteger('terca')->default('0');
            $table->tinyInteger('quarta')->default('0');
            $table->tinyInteger('quinta')->default('0');
            $table->tinyInteger('sexta')->default('0');
            $table->tinyInteger('sabado')->default('0');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dias');
    }
}
