<?php

namespace App\Http\Middleware;

use App\Models\Produto;
use Closure;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;

class Products
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        $dado = Produto::where('code',$request->code)->get();

        if(count($dado) == 0) return response()->json(["mensagem" => "Id não encontrado"], 400);

        return $next($request);
    }
}
