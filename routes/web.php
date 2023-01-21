<?php

use App\Services\PersisteDadosService;
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
    $teste = file_get_contents('/var/www/html/storage/app/products_01Extraido.txt');
    return PersisteDadosService::persisteDados($teste);
});
