<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\HospitalRequest;
use Axdlee\Config\Rewrite;

class HospitalController extends Controller
{
    public function informacoes()
    {
    	return view('hospital.manipular');
    }

    public function salvar(HospitalRequest $requisicao)
    {
        if($requisicao->logo != null)
            $requisicao->logo->storeAs('public', 'logo.jpg');

    	$writer = new Rewrite;

        $filePath = __DIR__ . '/../../../config/prontuario.php';
        $tmpFile = __DIR__ . '/../../../config/prontuario.temp.php';

        copy($filePath, $tmpFile);

        $contents = $writer->toFile($filePath, [
        	'nome' => $requisicao->sistema,
        	'paginacao' => $requisicao->paginacao,
        	'hospital.nome' => $requisicao->nome,
        	'hospital.local' => $requisicao->local
        ]);


        unlink($tmpFile);

        $exit = \Artisan::call('config:cache');


    	return redirect($_SERVER['HTTP_REFERER'])->withMsg('Dados foram salvos!');
    }
}
