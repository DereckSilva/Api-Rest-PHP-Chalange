<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Psy\Readline\Hoa\FileGeneric;

class ArquivoController extends Controller
{
    public function getNomeArquivo(){
        $teste = '';
        $arquivo = file("/var/www/html/storage/app/produtos.txt");

        foreach($arquivo as $linha){

            $pos = strpos($linha, '.');
            $novoArquivo = substr($linha, 0, $pos);

            $conteudo = file_get_contents("/var/www/html/storage/app/".$novoArquivo.".log.txt");

            $info = explode(',', $conteudo);

            return $info;

        }
    }
}
