<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterNaoMedicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('nao_medicos', function (Blueprint $table) {
            $table->integer('cabecalho_id')->unsigned()->nullable();

            $table->foreign('cabecalho_id')
              ->references('id')
              ->on('cabecalhos')
            ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nao_medicos', function (Blueprint $table) {
            //
        });
    }
}
