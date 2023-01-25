<?php

namespace App\Http\Controllers;

use App\Services\ManipulacaoArquivoService;
use Exception;
use Faker\Core\Number;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Psy\Readline\Hoa\FileGeneric;

class ArquivoController extends Controller
{

    private $infoLogs = array();

    public function getNomeArquivo(){

        try {

            $arquivo = file("/var/www/html/storage/app/produtos.txt");

            foreach($arquivo as $linha){

                $pos = strpos($linha, '.');
                $novoArquivo = substr($linha, 0, $pos);
                $novoArquivo .= ".log.txt";
                if(Storage::exists($novoArquivo)){

                    $dadosCron = ManipulacaoArquivoService::formatarDados("/var/www/html/storage/app/".$novoArquivo);

                    $dadosCron["arquivo"] = $novoArquivo;

                    array_push($this->infoLogs, $dadosCron);
                }
            }

            return $this->infoLogs;

        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], 500);
        }

    }
}
