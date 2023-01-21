<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ConsultaEndPointService {

    private static $arquivo;

    public static function getArquivo($arquivo)
    {
        self::$arquivo = $arquivo;

        self::$arquivo = file_get_contents(self::$arquivo);

        return self::$arquivo;
    }
}
