<?php

namespace App\Services;

use App\Models\Produto;
use Exception;

class PersisteDadosProdutoService {

    public static function persisteDados(array $dados){

        try{

            Produto::create([
                'code' => $dados['code'],
                'imported_t' => now(),
                'status' => 'published',
                'url' => $dados['url'],
                'creator' => $dados['creator'],
                'created_t' => $dados['created_t'],
                'last_modified_t' => $dados['last_modified_t'],
                'product_name' => $dados['product_name'],
                'quantity' => $dados['quantity'],
                'brands' => $dados['brands'],
                'categories' => $dados['categories'],
                'labels' => $dados['labels'],
                'cities' => $dados['cities'],
                'purchase_places' => $dados['purchase_places'],
                'stores' => $dados['stores'],
                'ingredients_text' => $dados['ingredients_text'],
                'traces' => $dados['traces'],
                'serving_size' => $dados['serving_size'],
                'serving_quantity' => empty($dados['serving_quantity']) ? 0.00 : $dados['serving_quantity'],
                'nutriscore_score' => empty($dados['nutriscore_score'])  ? 0 : $dados['nutriscore_score'],
                'nutriscore_grade' => $dados['nutriscore_grade'],
                'main_category' => $dados['main_category'],
                'image_url' => $dados['image_url'],
            ]);
        }catch(Exception $e){
            return response()->json(["error" => $e->getMessage()], 500);
        }

    }

}
