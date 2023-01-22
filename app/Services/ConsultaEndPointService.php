<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ConsultaEndPointService {

    private static $arquivo;

    public static function getArquivo($arquivo)
    {
        try{

            self::$arquivo = $arquivo;

            self::$arquivo = file_get_contents(self::$arquivo);

            return self::$arquivo;

        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], 500);
        }
    }
}
