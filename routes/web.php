<?php

use App\Services\ConsultaEndPointService;
use App\Services\PersisteDadosService;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('te', function () {
    $texto = ConsultaEndPointService::getArquivo("https://challenges.coode.sh/food/data/json/index.txt");

    if(!Storage::exists("produtos.txt")){
        Storage::append("produtos.txt", $texto);
    }

    $arquivo = file("/var/www/html/storage/app/produtos.txt");


    foreach($arquivo as $linha)
    {
        $client = new Client();

        $response = $client->get("https://challenges.coode.sh/food/data/json/".trim($linha));

        $content = $response->getBody()->getContents();

        if(!Storage::exists(trim($linha))){
            Storage::put(trim($linha), $content);
            //ExtrairDadosService::extrairDados($linha);
            break;
        }else{
            Storage::delete(trim($linha));
            Storage::put(trim($linha), $content);
        }

        //PersisteDadosService::persisteDados(explode('}', '/var/www/html/storage/app/products_01Extraido.txt'));
    }
});
