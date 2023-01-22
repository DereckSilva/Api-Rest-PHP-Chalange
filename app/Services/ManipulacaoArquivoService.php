<?php

namespace App\Services;

use App\Models\Produto;
use Exception;

class ManipulacaoArquivoService
{
    private static $dados;
    private static $chaves = array();
    private static $valores = array();
    private static $novoArray = array();

    public static function formatarDados($dados, $persistir = null)
    {

        try{
            self::$dados = file($dados);

            foreach(self::$dados as $informacoes){
                $info = explode(',', $informacoes);

                foreach($info as $data){

                    $pos = strpos($data, ':');
                    $chave = substr($data, 0, $pos);
                    array_push(self::$chaves, preg_replace("/[{|}|;|-|\"| ]/", "",$chave));
                    $novoDado = substr($data, $pos+1);
                    array_push(self::$valores, preg_replace("/[\\\|;|\"\/|}]/", "", $novoDado));

                }

                self::$novoArray = array_combine(self::$chaves, self::$valores);

                if($persistir){

                    PersisteDadosProdutoService::persisteDados(self::$novoArray);

                }else{

                    return self::$novoArray;
                }

            }
        }catch(Exception $e){
            return response()->json(["error"=>$e->getMessage()], 500);
        }

    }
}
