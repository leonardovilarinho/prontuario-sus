<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConsultasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');

            $table->datetime('horario');

            $table->text('obs')->nullable();

            $table->string('status', 250);

            $table->integer('usuario_id')->unsigned();
            $table->decimal('valor')->nullable();

            $table->foreign('usuario_id')
              ->references('id')
              ->on('usuarios')
            ->onDelete('cascade');

            $table->integer('paciente_id')->unsigned();

            $table->foreign('paciente_id')
              ->references('id')
              ->on('pacientes')
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
        Schema::dropIfExists('consultas');
    }
}
