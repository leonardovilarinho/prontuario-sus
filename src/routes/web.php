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
    Route::get('bloquear/{id}', 'UsuarioController@bloquear');
    Route::get('desbloquear/{id}', 'UsuarioController@desbloquear');

    Route::get('apagar/{id}', 'UsuarioController@apagar');
});

Route::group(['prefix' => 'medicos', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('', 'MedicoController@lista');

    Route::get('novo', 'MedicoController@criar');
    Route::post('novo', 'MedicoController@salvar');

    Route::get('editar/{id}', 'MedicoController@edicao');
    Route::put('editar/{id}', 'MedicoController@editar');
});

Route::group(['prefix' => 'administradores', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('', 'AdministradorController@lista');

    Route::get('novo', 'AdministradorController@criar');
    Route::post('novo', 'AdministradorController@salvar');

    Route::get('editar/{id}', 'AdministradorController@edicao');
    Route::put('editar/{id}', 'AdministradorController@editar');
});