<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use ZipArchive;

class ConsultaEndPointService {

    private $arquivo;
    private $caminhoArquivo;

    public function __construct($endpoint)
    {
        $this->caminhoArquivo = $endpoint;
    }

    public function getArquivo()
    {
        $this->arquivo = file_get_contents($this->caminhoArquivo);

        return $this->arquivo;
    }
}
