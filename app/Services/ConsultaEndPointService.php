<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ConsultaEndPointService {

    private static $arquivo;
    private static $caminhoArquivo;

    public static function getArquivo()
    {
        self::$arquivo = file_get_contents(self::$caminhoArquivo);

        return self::$arquivo;
    }
}
