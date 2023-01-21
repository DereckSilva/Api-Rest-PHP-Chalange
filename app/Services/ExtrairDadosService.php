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

    }

}
