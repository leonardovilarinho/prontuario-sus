<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterReceituarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('receituarios', function (Blueprint $table) {
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
        Schema::table('receituarios', function (Blueprint $table) {
            //
        });
    }
}
