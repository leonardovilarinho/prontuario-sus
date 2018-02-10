<?php

Route::get('/', 'LoginController@entrar');
Route::post('/', 'LoginController@logar');
Route::get('sair', 'LoginController@sair');
Route::get('sobre', 'PainelController@sobre');

Route::group(['middleware' => 'autenticacao:*'], function() {
    Route::get('perfil', 'UsuarioController@perfil');
    Route::put('perfil', 'UsuarioController@salvarPerfil');
    Route::put('perfil/senha', 'UsuarioController@alterarSenha');
});

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
    Route::get('secretarios/{id}', 'UsuarioController@secretarios');
    Route::post('secretarios/{id}', 'UsuarioController@trocarSecretarios');
    Route::get('redefinir/{id}', 'UsuarioController@redefinir');
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
        Route::get('gerenciar/{id}', 'MedicoController@gerenciar');

        Route::get('{id}/consultas', 'ConsultaController@lista')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => 'autenticacao:med|nme'], function() {
        Route::get('config', 'MedicoController@config');
        Route::post('config/ferias', 'MedicoController@salvarFerias');

        Route::post('config/carga', 'CargaHorariaController@salvar');

        Route::post('lugar', 'MedicoController@lugar');

        Route::get('dia', 'MedicoController@doDia');
        Route::get('financas', 'MedicoController@financas');

        Route::get('consulta/{id}/atender', 'ConsultaController@atender');

        Route::get('folga', 'FeriaController@lista');
        Route::post('folga', 'FeriaController@salvar');
        Route::get('folga/{id}/apagar', 'FeriaController@apagar')->where('id', '[0-9]+');
    });

     Route::group(['middleware' => 'autenticacao:sec|adm'], function() {

        Route::get('{id}/consulta/data', 'ConsultaController@data')->where('id', '[0-9]+');
        Route::get('{id}/consulta/horarios', 'ConsultaController@horarios')->where('id', '[0-9]+');
        Route::get('{id}/consulta/marcar', 'ConsultaController@marcar')->where('id', '[0-9]+');
        Route::get('{id}/consulta/finalizar', 'ConsultaController@finalizar')->where('id', '[0-9]+');
        Route::post('{id}/consulta/finalizar', 'ConsultaController@salvar')->where('id', '[0-9]+');

        Route::get('{id}/consulta/{consulta}/cancelar', 'ConsultaController@apagar')->where('id', '[0-9]+');

        Route::get('{id}/consulta/{consulta}/editar', 'ConsultaController@editar')->where('id', '[0-9]+');

         Route::post('{id}/consulta/{consulta}/editar', 'ConsultaController@salvarEdicao')->where('id', '[0-9]+');
    });
});

Route::group(['prefix' => 'administradores', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('', 'AdministradorController@lista');

    Route::get('gerenciar/{id}', 'AdministradorController@gerenciar');

    Route::get('novo', 'AdministradorController@criar');
    Route::post('novo', 'AdministradorController@salvar');

    Route::get('editar/{id}', 'AdministradorController@edicao')->where('id', '[0-9]+');
    Route::put('editar/{id}', 'AdministradorController@editar')->where('id', '[0-9]+');
});

Route::group(['prefix' => 'nao-medicos', 'middleware' => 'autenticacao:adm|nme|sec'], function() {
    Route::get('', 'NaoMedicoController@lista');
    Route::get('gerenciar/{id}', 'NaoMedicoController@gerenciar');

    Route::get('novo', 'NaoMedicoController@criar');
    Route::post('novo', 'NaoMedicoController@salvar');

    Route::get('editar/{id}', 'NaoMedicoController@edicao')->where('id', '[0-9]+');
    Route::put('editar/{id}', 'NaoMedicoController@editar')->where('id', '[0-9]+');
    Route::get('historico/{id}', 'NaoMedicoController@historico')->where('id', '[0-9]+');

    Route::group(['middleware' => 'autenticacao:nme'], function() {
        Route::get('dia', 'NaoMedicoController@doDia');
        Route::post('lugar', 'NaoMedicoController@lugar');
    });
});

Route::group(['prefix' => 'secretarios', 'middleware' => 'autenticacao:adm|sec'], function() {
    Route::get('', 'SecretarioController@lista');
    Route::get('gerenciar/{id}', 'SecretarioController@gerenciar');

    Route::get('novo', 'SecretarioController@criar');
    Route::post('novo', 'SecretarioController@salvar');

    Route::group(['middleware' => 'autenticacao:adm'], function() {

        Route::get('editar/{id}', 'SecretarioController@edicao')->where('id', '[0-9]+');
        Route::put('editar/{id}', 'SecretarioController@editar')->where('id', '[0-9]+');
    });
});

Route::group(['prefix' => 'hospital', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('config', 'HospitalController@configuracoes');
    Route::post('config', 'HospitalController@salvarConfiguracoes');

    Route::get('equipamentos', 'EquipamentoController@lista');
    Route::post('equipamentos/novo', 'EquipamentoController@salvar');
    Route::get('equipamentos/{id}/apagar', 'EquipamentoController@apagar')->where('id', '[0-9]+');

    Route::get('medicamentos', 'MedicamentoController@lista');
    Route::post('medicamentos/novo', 'MedicamentoController@salvar');
    Route::get('medicamentos/{id}/apagar', 'MedicamentoController@apagar')->where('id', '[0-9]+');
});


Route::group(['prefix' => 'pacientes'], function() {

    Route::group(['middleware' => 'autenticacao:sec|med|nme|adm'], function() {
        Route::get('', 'PacienteController@lista');
        Route::get('gerenciar/{id}', 'PacienteController@gerenciar');
    });

    Route::group(['middleware' => 'autenticacao:sec|adm'], function() {
        Route::get('novo', 'PacienteController@criar');
        Route::post('novo', 'PacienteController@salvar');

        Route::get('editar/{id}', 'PacienteController@edicao')->where('id', '[0-9]+');
        Route::put('editar/{id}', 'PacienteController@editar')->where('id', '[0-9]+');

        Route::get('apagarfoto/{id}', 'PacienteController@apagarfoto')->where('id', '[0-9]+');

        Route::get('{id}/consultas', 'ConsultaController@listaPaciente')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => 'autenticacao:adm'], function() {
        Route::get('apagar/{id}', 'PacienteController@apagar')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => 'autenticacao:med|nme'], function() {
        Route::get('{id}/evolucoes/nova', 'EvolucaoController@nova')->where('id', '[0-9]+');
        Route::post('{id}/evolucoes/nova', 'EvolucaoController@salvar')->where('id', '[0-9]+');

        Route::get('{id}/receituarios/novo', 'ReceituarioController@novo')->where('id', '[0-9]+');
        Route::post('{id}/receituarios/novo', 'ReceituarioController@salvar')->where('id', '[0-9]+');


        Route::get('{id}/prescricoes/nova', 'PrescricaoController@nova')->where('id', '[0-9]+');
        Route::post('{id}/prescricoes/nova', 'PrescricaoController@salvar')->where('id', '[0-9]+');

        Route::get('{id}/prescricoes/{prescricao}/addmed', 'PrescricaoController@addmed')->where('id', '[0-9]+');
        Route::post('{id}/prescricoes/{prescricao}/addmed', 'PrescricaoController@addmedSal')->where('id', '[0-9]+');

        Route::get('{id}/prescricoes/{prescricao}/remmed/{med}', 'PrescricaoController@remmed')->where('id', '[0-9]+');

         Route::get('{id}/prescricoes/{prescricao}/addequ', 'PrescricaoController@addequ')->where('id', '[0-9]+');
        Route::post('{id}/prescricoes/{prescricao}/addequ', 'PrescricaoController@addequSal')->where('id', '[0-9]+');

        Route::get('{id}/prescricoes/{prescricao}/remequ/{med}', 'PrescricaoController@remequ')->where('id', '[0-9]+');
    });

    Route::group(['middleware' => 'autenticacao:med|nme|adm'], function() {
        Route::get('{id}/evolucoes', 'EvolucaoController@lista')->where('id', '[0-9]+');
        Route::get('{id}/hevo', 'EvolucaoController@historico')->where('id', '[0-9]+');
    
        Route::get('{id}/evolucoes/{ev}/detalhes', 'EvolucaoController@detalhes')->where('id', '[0-9]+');

        Route::get('{id}/receituarios', 'ReceituarioController@lista')->where('id', '[0-9]+');

        Route::get('{id}/hrec', 'ReceituarioController@historico')->where('id', '[0-9]+');

        Route::get('{id}/receituarios/{rec}/detalhes', 'ReceituarioController@detalhes')->where('id', '[0-9]+');

        Route::get('{id}/receituarios/{rec}/detalhes2', 'ReceituarioController@detalhes2')->where('id', '[0-9]+');

        Route::get('{id}/prescricoes', 'PrescricaoController@lista')->where('id', '[0-9]+');
       
        Route::get('{id}/prescricoes/{prescricao}/gerenciar', 'PrescricaoController@gerenciar')->where('id', '[0-9]+');
    });

     Route::group(['middleware' => 'autenticacao:adm|med'], function() {
        Route::get('evolucoes/{id}/apagar', 'EvolucaoController@apagar')->where('id', '[0-9]+');
    
        Route::get('receituarios/{id}/apagar', 'ReceituarioController@apagar')->where('id', '[0-9]+');

        Route::get('prescricoes/{id}/apagar', 'PrescricaoController@apagar')->where('id', '[0-9]+');
    });
});

Route::group(['prefix' => 'postos', 'middleware' => 'autenticacao:adm'], function() {
    Route::get('', 'CabecalhoController@lista');
    Route::get('gerenciar/{id}', 'CabecalhoController@gerenciar');

    Route::get('novo', 'CabecalhoController@criar');
    Route::post('novo', 'CabecalhoController@salvar');

    Route::get('usuarios/{id}', 'CabecalhoController@usuarios');
    Route::post('usuarios/{id}', 'CabecalhoController@trocarUsuarios');

    Route::get('ativar/{id}', 'CabecalhoController@ativar')->where('id', '[0-9]+');
    Route::get('desativar/{id}', 'CabecalhoController@desativar')->where('id', '[0-9]+');

    Route::get('editar/{id}', 'CabecalhoController@edicao')->where('id', '[0-9]+');
    Route::put('editar/{id}', 'CabecalhoController@editar')->where('id', '[0-9]+');
});


Route::group(['middleware' => 'autenticacao:med|nme'], function() {
    Route::get('modelos', 'ModeloController@lista');
    Route::post('modelos', 'ModeloController@novo');
    Route::post('modelos/manipular', 'ModeloController@manipular');
    //->where('id', '[0-9]+')
});