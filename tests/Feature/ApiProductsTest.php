<?php

namespace Tests\Feature;

use App\Models\Produto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiProductsTest extends TestCase
{

    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_verified_return_data_of_products()
    {
        $response = $this->getJson('api/produtos');

        $dados = Produto::paginate();

        $dados = json_decode($dados);

        $response->assertJsonFragment([
            $dados
        ]);
    }

    public function test_verified_return_one_error_code_product()
    {
        $id = '00001221';

        $response = $this->getJson('api/produtos/'.$id);

        $response->assertStatus(400);

        $response->assertJsonFragment([
            "mensagem" => "Id não encontrado"
        ]);

    }

    public function test_updated_product()
    {
        $id = '0000000000031';

        $response = $this->putJson('api/produtos/'.$id, [
            'creator' => 'dereck'
        ]);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "mensagem" => "Dados Atualizados com sucesso"
        ]);

    }

    public function test_delete_product()
    {
        $id = '0000000000031';

        $response = $this->deleteJson('api/produtos/'.$id);

        $response->assertStatus(200);

        $response->assertJsonFragment([
            "mensagem" => "Dado Excluído com sucesso"
        ]);

    }
}
