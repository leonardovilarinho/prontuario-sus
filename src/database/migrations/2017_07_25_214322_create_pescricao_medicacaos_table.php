<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePescricaoMedicacaosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pescricao_medicacaos', function (Blueprint $table) {
            $table->increments('id');

            $table->string('dose', 50);
            $table->integer('intervalo');
            $table->integer('tempo');

            $table->integer('prescricao_id')->unsigned();
            $table->foreign('prescricao_id')
              ->references('id')
              ->on('prescricaos')
            ->onDelete('cascade');

            $table->integer('medicacao_id')->unsigned();
            $table->foreign('medicacao_id')
              ->references('id')
              ->on('medicamentos')
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
        Schema::dropIfExists('pescricao_medicacaos');
    }
}
