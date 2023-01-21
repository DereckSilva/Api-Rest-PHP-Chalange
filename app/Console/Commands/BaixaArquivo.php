<?php

namespace App\Console\Commands;

use App\Services\ConsultaEndPointService;
use App\Services\ExtrairDadosService;
use GuzzleHttp\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use File;

class BaixaArquivo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'baixa:arquivo';

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
        $endpoint = new ConsultaEndPointService("https://challenges.coode.sh/food/data/json/index.txt");

        $texto = $endpoint->getArquivo();

        if(!Storage::exists("produtos.txt")){
            Storage::append("produtos.txt", $texto);
        }

        $arquivo = file("/var/www/html/storage/app/produtos.txt");


        foreach($arquivo as $linha)
        {
            $client = new Client();

            $response = $client->get("https://challenges.coode.sh/food/data/json/".trim($linha));


            $content = $response->getBody()->getContents();

            $pos = strpos($linha, '.');
            $novoArquivo = substr($linha, 0, $pos);

            if(!Storage::exists($novoArquivo.'.json.gz')){
                Storage::put($novoArquivo.'.json.gz', $content);
                break;
            }else{
                Storage::delete($novoArquivo.'.json.gz');
                Storage::put($novoArquivo.'.json.gz', $content);
            }
        }



    }
}
