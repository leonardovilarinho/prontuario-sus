<?php

Route::get('/', 'LoginController@entrar');
Route::post('/', 'LoginController@logar');
Route::get('sair', 'LoginController@sair');


Route::group(['prefix' => 'administradores'], function() {
    Route::get('primeiro', 'AdministradorController@primeiro');
    Route::post('primeiro', 'AdministradorController@cadastrarPrimeiro');
});

Route::group(['prefix' => 'painel'], function() {
    Route::get('', 'PainelController@inicial');
});

Route::group(['prefix' => 'usuarios', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('bloquear/{id}', 'UsuarioController@bloquear')->where('id', '[0-9]+');
    Route::get('desbloquear/{id}', 'UsuarioController@desbloquear')->where('id', '[0-9]+');

    Route::get('apagar/{id}', 'UsuarioController@apagar');
});

Route::group(['prefix' => 'medicos'], function() {

    Route::group(['middleware' => 'autenticacao:adm'], function() {
        Route::get('novo', 'MedicoController@criar');
        Route::post('novo', 'MedicoController@salvar');

        Route::get('editar/{id}', 'MedicoController@edicao')->where('id', '[0-9]+');
        Route::put('editar/{id}', 'MedicoController@editar')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => 'autenticacao:adm|sec'], function() {
        Route::get('', 'MedicoController@lista');
    });

    Route::group(['middleware' => 'autenticacao:med'], function() {
        Route::get('ferias', 'MedicoController@ferias');
        Route::post('ferias', 'MedicoController@salvarFerias');

        Route::get('dia', 'MedicoController@doDia');
    });

     Route::group(['middleware' => 'autenticacao:sec'], function() {
        Route::get('{id}/consultas', 'ConsultaController@lista')->where('id', '[0-9]+');

        Route::get('{id}/consulta/data', 'ConsultaController@data')->where('id', '[0-9]+');
        Route::get('{id}/consulta/horarios', 'ConsultaController@horarios')->where('id', '[0-9]+');
        Route::get('{id}/consulta/marcar', 'ConsultaController@marcar')->where('id', '[0-9]+');
        Route::get('{id}/consulta/finalizar', 'ConsultaController@finalizar')->where('id', '[0-9]+');
        Route::post('{id}/consulta/finalizar', 'ConsultaController@salvar')->where('id', '[0-9]+');

        Route::get('{id}/consulta/{consulta}/cancelar', 'ConsultaController@apagar')->where('id', '[0-9]+');
    });
});

Route::group(['prefix' => 'administradores', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('', 'AdministradorController@lista');

    Route::get('novo', 'AdministradorController@criar');
    Route::post('novo', 'AdministradorController@salvar');

    Route::get('editar/{id}', 'AdministradorController@edicao')->where('id', '[0-9]+');
    Route::put('editar/{id}', 'AdministradorController@editar')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'nao-medicos', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('', 'NaoMedicoController@lista');

    Route::get('novo', 'NaoMedicoController@criar');
    Route::post('novo', 'NaoMedicoController@salvar');

    Route::get('editar/{id}', 'NaoMedicoController@edicao')->where('id', '[0-9]+');
    Route::put('editar/{id}', 'NaoMedicoController@editar')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'secretarios', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('', 'SecretarioController@lista');

    Route::get('novo', 'SecretarioController@criar');
    Route::post('novo', 'SecretarioController@salvar');

    Route::get('editar/{id}', 'SecretarioController@edicao')->where('id', '[0-9]+');
    Route::put('editar/{id}', 'SecretarioController@editar')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'hospital', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('', 'HospitalController@informacoes');
    Route::post('', 'HospitalController@salvar');
});

Route::group(['prefix' => 'carga', 'middleware' => 'autenticacao:med'], function() {
    Route::get('', 'CargaHorariaController@manipular');
    Route::post('', 'CargaHorariaController@salvar');
});

Route::group(['prefix' => 'pacientes'], function() {

    Route::group(['middleware' => 'autenticacao:sec|med|nme'], function() {
        Route::get('', 'PacienteController@lista');
    });

    Route::group(['middleware' => 'autenticacao:sec'], function() {
        Route::get('novo', 'PacienteController@criar');
        Route::post('novo', 'PacienteController@salvar');

        Route::get('editar/{id}', 'PacienteController@edicao')->where('id', '[0-9]+');
        Route::put('editar/{id}', 'PacienteController@editar')->where('id', '[0-9]+');

        Route::get('apagar/{id}', 'PacienteController@apagar')->where('id', '[0-9]+');

        Route::get('{id}/consultas', 'ConsultaController@listaPaciente')->where('id', '[0-9]+');
    });
});
