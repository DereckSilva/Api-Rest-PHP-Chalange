<?php

namespace App\Http\Controllers;

use App\Services\ManipulacaoArquivoService;
use Exception;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Psy\Readline\Hoa\FileGeneric;

class ArquivoController extends Controller
{
    public function getNomeArquivo(){

        try {

            $arquivo = file("/var/www/html/storage/app/produtos.txt");

            foreach($arquivo as $linha){

                $pos = strpos($linha, '.');
                $novoArquivo = substr($linha, 0, $pos);

                $dadosCron = ManipulacaoArquivoService::formatarDados("/var/www/html/storage/app/".$novoArquivo.".log.txt");

                $segundosData = $dadosCron["Data"];
                $segundoIniCron = $dadosCron["InicioCron"];

                $valueData = substr($segundosData, 18);
                $valueIniCron = substr($segundoIniCron, 18);

                $dadosCron["totalOnlineLog"] = intval($valueData) - intval($valueIniCron);

                return response()->json(["dados"=>$dadosCron], 200);
            }
        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], 500);
        }

    }
}
