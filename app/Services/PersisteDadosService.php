<?php

namespace App\Services;

class PersisteDadosService {

    private static $dados;

    public static function persisteDados($dados)
    {

        $regex = '/r|\|\;/';
        $teste = preg_replace('[\\\;\]', '',$dados);
        self::$dados = json_decode($teste);
        return self::$dados;
    }
}
