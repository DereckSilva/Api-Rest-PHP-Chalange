<?php

use App\Http\Controllers\ArquivoController;
use App\Http\Controllers\ProductsController;
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

Route::get('/', [ArquivoController::class, 'getNomeArquivo']);

Route::prefix('produtos')->group(function(){

    Route::middleware([\App\Http\Middleware\Products::class])
        ->group(function(){

            //desenvolvimento de rotas

            Route::get('/', function (){
                $dados = Produto::paginate();

                return ProductResource::collection($dados);
            })->withoutMiddleware('products');

            Route::get('{code}', function($code){

                $dados = Produto::where('code',$code)->get();

                return ProductResource::collection($dados);
            });

            Route::put('{code}', [ProductsController::class, 'atualizaDados']);

            Route::delete('{code}', [ProductsController::class, 'deletaDado']);
        });
});
