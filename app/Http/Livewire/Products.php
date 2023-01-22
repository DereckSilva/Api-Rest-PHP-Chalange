<?php

namespace App\Http\Livewire;

use App\Http\Controllers\ArquivoController;
use Livewire\Component;

class Products extends Component
{
    public function render()
    {

        $arquivo = new ArquivoController();

        $dados = $arquivo->getNomeArquivo();

        return view('livewire.products', ['dados' => $dados]);
    }
}
