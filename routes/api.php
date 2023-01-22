<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Resources\ProductResource;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/', [ArquivoController::class, 'getNomeArquivo']);
Route::get('/', function(){
    return Response(["message" => "hello"]);
});

Route::get('te/{id}', function($id){

    $dados = Produto::where('code',$id)->get();

    return ProductResource::collection($dados);
});
