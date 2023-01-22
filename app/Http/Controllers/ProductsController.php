<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Produto;
use Exception;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    public function atualizaDados(Request $request, $code)
    {
        try{

            $possiveisValores = [
                'imported_t','status', "url", 'creator','created_t','last_modified_t','product_name',
                'quantity','brands','categories','labels','cities','purchase_places','stores','ingredients_text',
                'traces','serving_size','serving_quantity','nutriscore_score','nutriscore_grade',
                'main_category','image_url',
            ];

            for($i = 0; $i < count($possiveisValores); $i++){

                $array  = $request->all();

                if(array_key_exists($possiveisValores[$i], $array)){

                    Produto::where('code', $code)->update([
                        $possiveisValores[$i] => $array[$possiveisValores[$i]]
                    ]);
                }
            }

            return response()->json(["mensagem"=>'Dados Atualizados com sucesso'], 200);

        }catch(Exception $e){
            return response()->json(['error'=> $e->getMessage()], 500);
        }

    }

    public function deletaDado($code)
    {
        try{

            Produto::where('code', $code)->update([
                'status' => "trash"
            ]);

            return response()->json(["mensagem"=>'Dado Excluído com sucesso'], 200);

        }catch(Exception $e){
            return response()->json(['error'=> $e->getMessage()], 500);
        }

    }
}
