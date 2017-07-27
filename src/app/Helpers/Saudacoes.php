<?php

namespace App\Helpers;

class Saudacoes {
    public static function gerar() {
        date_default_timezone_set('America/Sao_Paulo');
        $hora = date('H');

        if( $hora >= 6 and $hora <= 12 )
            return 'Bom dia';
        else if ( $hora > 12 and $hora <= 18  )
            return 'Boa tarde';

        return 'Boa noite';
    }

    public static function idade($nascimento)
    {

	    $dia = date('d');
	    $mes = date('m');
	    $ano = date('Y');


	    $nascimento = explode('-', $nascimento);
	    $dianasc = ($nascimento[2]);
	    $mesnasc = ($nascimento[1]);
	    $anonasc = ($nascimento[0]);

	    //Calculando sua idade
	    $idade = $ano - $anonasc; // simples, ano- nascimento!

	    if ($mes < $mesnasc) // se o mes é menor, só subtrair da idade
	    {
	        $idade--;
	        return $idade;
	    }
	    elseif ($mes == $mesnasc && $dia <= $dianasc) {
	        $idade--;
	        return $idade;
	    }

	    return $idade;
    }
}