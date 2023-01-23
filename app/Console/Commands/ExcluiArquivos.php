<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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
    }
}
