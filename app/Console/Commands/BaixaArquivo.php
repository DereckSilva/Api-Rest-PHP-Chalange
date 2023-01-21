<?php

namespace App\Console\Commands;

use App\Services\ConsultaEndPointService;
use App\Services\ExtrairDadosService;
use App\Services\PersisteDadosService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
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
        $texto = ConsultaEndPointService::getArquivo("https://challenges.coode.sh/food/data/json/index.txt");

        if(!Storage::exists("produtos.txt")){
            Storage::append("produtos.txt", $texto);
        }

        $arquivo = file("/var/www/html/storage/app/produtos.txt");


        foreach($arquivo as $linha)
        {
            ExtrairDadosService::extrairDados($linha);

            $client = new Client();

            $response = $client->get("https://challenges.coode.sh/food/data/json/".trim($linha));

            $content = $response->getBody()->getContents();

            if(!Storage::exists(trim($linha))){
                Storage::put(trim($linha), $content);
                break;
            }else{
                Storage::delete(trim($linha));
                Storage::put(trim($linha), $content);
            }

            //PersisteDadosService::persisteDados(explode('}', '/var/www/html/storage/app/products_01Extraido.txt'));
        }



    }
}
