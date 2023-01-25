<?php

namespace App\Services;

use Exception;
use Illuminate\Contracts\Cache\Store;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ExtrairDadosService {

    private static $arquivo;

    public static function extrairDados($arquivo)
    {
        try{

            self::$arquivo = $arquivo;

            //montando arquivo txt com os dados do arquivo compactado
            $arquivogz = file_get_contents('/var/www/html/storage/app/'.trim(self::$arquivo));
            $conteudogz = gzdecode($arquivogz);

            $pos = strpos(trim(self::$arquivo), '.');
            $novoArquivo = substr(trim(self::$arquivo), 0, $pos);

            Storage::put($novoArquivo.'.txt', $conteudogz);

            $src = fopen('/var/www/html/storage/app/'.$novoArquivo.'.txt', 'r');

                Storage::append($novoArquivo.'Extraido.txt', '');
                $dest = fopen('/var/www/html/storage/app/'.$novoArquivo.'Extraido.txt', 'w');

            stream_copy_to_stream($src, $dest, 580294);
        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }

}
