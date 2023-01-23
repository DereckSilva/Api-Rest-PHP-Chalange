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

                    $segundosData = $dadosCron["Data"];
                    $segundoIniCron = $dadosCron["InicioCron"];

                    $valueData = substr($segundosData, 18);
                    $valueIniCron = substr($segundoIniCron, 18);

                    $dadosCron["totalOnlineLog"] = intval($valueData) - intval($valueIniCron);

                    array_push($this->infoLogs, $dadosCron);
                }
            }
        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], 500);
        }

    }

    public function getInfoLogs(){
        try {

            //executa
            $this->getNomeArquivo();

            $totalOnlineLog = 0;

            foreach($this->infoLogs as $arquivo){
                $totalOnlineLog += $arquivo['totalOnlineLog'];
            }

            $this->infoLogs["total"] = $totalOnlineLog;

            return $this->infoLogs;

        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}
