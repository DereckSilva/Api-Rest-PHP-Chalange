<?php

namespace App\Services;

use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ExtrairDadosService {

    private static $arquivo;

    public static function extrairDados($arquivo)
    {
        self::$arquivo = $arquivo;

        //montando arquivo txt com os dados do arquivo compactado
        $arquivogz = file_get_contents('/var/www/html/storage/app/'.trim(self::$arquivo));
        $conteudogz = gzdecode($arquivogz);

        $pos = strpos(trim(self::$arquivo), '.');
        $novoArquivo = substr(trim(self::$arquivo), 0, $pos);

        if(Storage::exists($novoArquivo.'.txt')){
            Storage::delete($novoArquivo.'.txt');
            Storage::put($novoArquivo.'.txt', $conteudogz);
        }else{
            Storage::put($novoArquivo.'.txt', $conteudogz);
        }

        $src = fopen('/var/www/html/storage/app/'.$novoArquivo.'.txt', 'r');

        if(Storage::exists($novoArquivo.'Extraido.txt')){
            Storage::delete($novoArquivo.'Extraido.txt');
            Storage::append($novoArquivo.'Extraido.txt', '');
            $dest = fopen('/var/www/html/storage/app/'.$novoArquivo.'Extraido.txt', 'w');
        }else{
            Storage::append($novoArquivo.'Extraido.txt', '');
            $dest = fopen('/var/www/html/storage/app/'.$novoArquivo.'Extraido.txt', 'w');
        }

        stream_copy_to_stream($src, $dest, 580294);
    }

}
