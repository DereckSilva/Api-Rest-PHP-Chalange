<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ExtrairDadosService {

    private $arquivo;

    public function __construct($arquivo)
    {
        $this->arquivo = $arquivo;
    }

    public function extrairDados()
    {
        //montando arquivo txt com os dados do arquivo compactado
        $gzippedFile = file_get_contents('/var/www/html/storage/app/products_01.json.gz');
        $contents = gzdecode($gzippedFile);
        Storage::put('file.txt', $contents);
    }

}
