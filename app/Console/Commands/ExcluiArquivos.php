<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class ExcluiArquivos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'exclui:arquivo';

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
        $arquivos = file("/var/www/html/storage/app/arquivosGerados.txt");

        foreach($arquivos as $arquivo){

            if(Storage::exists(trim($arquivo))){
                Storage::delete(trim($arquivo));
            }
        }

        $produtosEx = file("/var/www/html/storage/app/produtosExtraidos.txt");
        $novoArquivo = array();

        foreach($produtosEx as $arquivo){
            if($arquivo != ''){
                array_push($novoArquivo, $arquivo);
            }
        }

        //remover arquivo apenas com nove valores
        foreach($produtosEx as $arquivo){

            if(count($novoArquivo) == 9){
                Cache::forget(trim($arquivo));
            }
        }

        if(count($novoArquivo) == 9){
            Storage::delete("produtosExtraidos.txt");
            Storage::append("produtosExtraidos.txt", "");
        }
    }
}
