<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePacientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pacientes', function (Blueprint $table) {
            $table->increments('id');

            $table->string('nome', 150);
            $table->string('prontuario', 20);
            $table->string('leito', 20)->nullable();
            $table->date('nascimento');
            $table->string('convenio', 40);
            $table->string('num_convenio', 50)->nullable();
            $table->enum('sexo', ['Masculino', 'Feminino']);
            $table->enum('civil', ['Solteiro', 'Divorciado', 'Casado', 'Viúvo', 'Separado'])->nullable();
            $table->enum('cor', ['Preta', 'Branca', 'Parda', 'Indigena', 'Amarela', 'Não declarado'])->nullable();
            $table->string('naturalidade', 30)->nullable();
            $table->string('grau', 80)->nullable();
            $table->string('cpf', 11)->nullable();
            $table->string('profissao', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('telefone', 15)->nullable();
            $table->string('endereco')->nullable();
            $table->string('bairro', 50)->nullable();
            $table->string('cidade', 50)->nullable();
            $table->string('cep', 10)->nullable();
            $table->string('uf', 2)->nullable();
            $table->text('obs')->nullable();

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
        Schema::dropIfExists('pacientes');
    }
}
