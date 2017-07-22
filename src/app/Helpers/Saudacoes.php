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
}