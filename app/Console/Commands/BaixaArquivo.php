<?php

namespace App\Console\Commands;

use App\Jobs\DownloadFiles;
use App\Jobs\GetZipFile;
use App\Services\ConsultaEndPointService;
use App\Services\ExtrairDadosService;
use App\Services\ManipulacaoArquivoService;
use App\Services\PersisteDadosService;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class BaixaArquivo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'baixa:arquivo';
    private $endpoint ;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {

        DownloadFiles::dispatch('https://challenges.coode.sh/food/data/json/index.txt',
                                '/openFood/products.txt'
        );

        GetZipFile::dispatch('https://challenges.coode.sh/food/data/json/',
                             '/var/www/html/storage/app/openFood/products.txt'
        );

        /*$arquivo = file("/var/www/html/storage/app/produtos.txt");

        foreach($arquivo as $linha)
        {

            $client = new Client();

            $response = $client->get("https://challenges.coode.sh/food/data/json/".trim($linha));

            $content = $response->getBody()->getContents();

            if(!Cache::has(trim($linha))){

                Cache::put(trim($linha), trim($linha), 604800);
                Storage::put(trim($linha), $content);
                Storage::append("produtosExtraidos.txt", trim($linha));

                ExtrairDadosService::extrairDados($linha);

                $pos = strpos(trim($linha), '.');
                $novoArquivo = substr(trim($linha), 0, $pos);

                //manipula arquivo para ser inserido na base de dados
                ManipulacaoArquivoService::formatarDados('/var/www/html/storage/app/'.$novoArquivo.'Extraido.txt', true);

                $dadosCron = '{Conexão com base: Ok, Leitura de dados: Ok, Escrita na base: Ok, ';
                $dadosCron .= "Data: ".now().", Inicio Cron: {$inicioCron}, Memória: ".memory_get_usage()."}";

                if(Storage::exists($novoArquivo.'.log.txt')){
                    Storage::delete($novoArquivo.'.log.txt');
                }
                Storage::append($novoArquivo.'.log.txt', $dadosCron);
                break;
            }

        }*/
    }
}
