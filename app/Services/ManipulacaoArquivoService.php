<?php

namespace App\Services;

use App\Models\Produto;

class ManipulacaoArquivoService
{
    private static $dados;
    private static $chaves = array();
    private static $valores = array();
    private static $novoArray = array();

    public static function formatarDados($dados)
    {

        self::$dados = file($dados);

        foreach(self::$dados as $informacoes){
            $info = explode(',', $informacoes);

            foreach($info as $data){

                $pos = strpos($data, ':');
                $chave = substr($data, 0, $pos);
                array_push(self::$chaves, preg_replace("/[{|}|;|-|\"| ]/", "",$chave));
                $novoDado = substr($data, $pos+1);
                array_push(self::$valores, preg_replace("/[\\\|;|\"\/]/", "", $novoDado));

            }

            self::$novoArray = array_combine(self::$chaves, self::$valores);

            PersisteDadosProdutoService::persisteDados(self::$novoArray);
        }
    }
}
