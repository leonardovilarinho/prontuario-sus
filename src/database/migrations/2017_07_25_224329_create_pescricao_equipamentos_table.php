<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePescricaoEquipamentosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pescricao_equipamentos', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('prescricao_id')->unsigned();
            $table->foreign('prescricao_id')
              ->references('id')
              ->on('prescricaos')
            ->onDelete('cascade');

            $table->integer('equipamento_id')->unsigned();
            $table->foreign('equipamento_id')
              ->references('id')
              ->on('equipamentos')
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
        Schema::dropIfExists('pescricao_equipamentos');
    }
}
