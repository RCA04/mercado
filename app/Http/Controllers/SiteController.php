<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Categoria;
use illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

/**
 * Controlador do Site Público
 * 
 * Gerencia as páginas públicas do e-commerce:
 * - Página inicial com produtos
 * - Detalhes de produtos
 * - Produtos por categoria
 */
class SiteController extends Controller
{
    use AuthorizesRequests;

    /* 
     * MÉTODO: index()
     * FUNÇÃO: Exibe a página inicial com produtos em destaque
     * RETORNA: View da página inicial com produtos paginados
     */
    public function index()
    {
        /* Busca produtos com paginação (3 por página) */
        $produtos = Produtos::paginate(3);
        
        /* Retorna a view da página inicial com os produtos */
        return view('site.home', compact('produtos'));
    }

    /* 
     * MÉTODO: details()
     * FUNÇÃO: Exibe os detalhes de um produto específico
     * PARÂMETROS: Slug do produto (URL amigável)
     * RETORNA: View com detalhes do produto
     */
    public function details($slug)
    {
        /* Busca o produto pelo slug (URL amigável) */
        $produto = Produtos::where('slug', $slug)->firstOrFail();

        /* Código comentado para implementação futura de autorização */
        /* Verifica se o usuário pode ver o produto */
        // if(Gate::allows('ver-produto', $produto)){
        //     return view('site.details', compact('produto'));
        // }

        /* Redireciona se o usuário não pode ver o produto */
        // if(Gate::denies('ver-produto', $produto)){
        //     return redirect()->route('site.index');
        // }
        // Gate::authorize('ver-produto', $produto);
        // $this->authorize('verProduto', $produto);
        
        /* Retorna a view com os detalhes do produto */
        return view('site.details', compact('produto'));
    }

    /* 
     * MÉTODO: categoria()
     * FUNÇÃO: Exibe produtos de uma categoria específica
     * PARÂMETROS: ID da categoria
     * RETORNA: View com produtos da categoria
     */
    public function categoria($id)
    {
        /* Busca a categoria pelo ID */
        $categoria = Categoria::findOrFail($id);
        
        /* Busca produtos que pertencem a esta categoria */
        $produtos = Produtos::where('id_categoria', $id)->paginate(1);
        
        /* Retorna a view com produtos e dados da categoria */
        return view('site.categoria', compact('produtos', 'categoria'));
    }
}
