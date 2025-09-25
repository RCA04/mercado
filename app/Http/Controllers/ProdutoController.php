<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produtos;
use App\Models\Categoria;
use Illuminate\Support\Str;

/**
 * Controlador de Produtos
 * 
 * Gerencia todas as operações CRUD relacionadas aos produtos:
 * - Listar produtos com busca e paginação
 * - Criar novos produtos
 * - Atualizar produtos existentes
 * - Excluir produtos
 */
class ProdutoController extends Controller
{
    /* 
     * MÉTODO: index()
     * FUNÇÃO: Exibe a lista de produtos com busca e paginação
     * PARÂMETROS: Request com parâmetros de busca opcionais
     * RETORNA: View com lista de produtos paginada
     */
    public function index(Request $request)
    {
        /* Pega o parâmetro de busca da URL (se existir) */
        $search = $request->query('search');

        /* Busca produtos do usuário logado com filtro de busca opcional */
        $produtos = Produtos::where('id_user', auth()->id()) /* 🔒 Só produtos do usuário logado */
            ->when($search, function ($query) use ($search) {
                /* Se houver busca, filtra por nome do produto */
                $query->where('nome', 'like', "%{$search}%");
            })
            ->paginate(5); /* Pagina os resultados (5 por página) */

        /* Busca todas as categorias para o formulário */
        $categorias = Categoria::all();
        
        /* Retorna a view com os dados necessários */
        return view('admin.produtos', compact('produtos', 'categorias', 'search'));
    }

    /* 
     * MÉTODO: destroy()
     * FUNÇÃO: Remove um produto do sistema
     * PARÂMETROS: ID do produto a ser removido
     * RETORNA: Redirecionamento com mensagem de sucesso
     */
    public function destroy($id)
    {
        /* Busca o produto pelo ID */
        $produto = Produtos::find($id);
        
        /* Remove o produto do banco de dados */
        $produto->delete();
        
        /* Redireciona para a lista de produtos com mensagem de sucesso */
        return redirect()->route('admin.produtos')->with('sucesso', 'produto removido com sucesso!');
    }

    /* 
     * MÉTODO: store()
     * FUNÇÃO: Cria um novo produto no sistema
     * PARÂMETROS: Request com dados do produto (nome, preço, categoria, imagem)
     * RETORNA: Redirecionamento com mensagem de sucesso
     */
    public function store(Request $request)
    {
        /* Pega todos os dados do formulário */
        $produto = $request->all();

        /* Validação dos campos obrigatórios */
        $validate = $request->validate([
            'nome' => 'required',        /* Nome é obrigatório */
            'preco' => 'required',       /* Preço é obrigatório */
            'id_categoria' => 'required' /* Categoria é obrigatória */
        ]);

        /* Upload da imagem se fornecida */
        if ($request->file('imagem')) {
            $file = $request->file('imagem');
            /* Gera nome único para o arquivo (data + nome original) */
            $fileName = date('dmYH') . '_' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            /* Move o arquivo para a pasta de produtos */
            $file->move(public_path('img/products'), $fileName);
            /* Salva o nome do arquivo nos dados do produto */
            $produto['imagem'] = $fileName;
        }

        /* Gera slug baseado no nome do produto (URL amigável) */
        $produto['slug'] = Str::slug($request->nome);
        
        /* Cria o produto no banco de dados */
        $produto = Produtos::create($produto);
        
        /* Redireciona para a lista de produtos com mensagem de sucesso */
        return redirect()->route('admin.produtos')->with('sucesso', 'produto cadastrado com sucesso');
    }

    /* 
     * MÉTODO: update()
     * FUNÇÃO: Atualiza um produto existente no sistema
     * PARÂMETROS: Request com dados atualizados do produto
     * RETORNA: Redirecionamento com mensagem de sucesso
     */
    public function update(Request $request)
    {
        /* Busca o produto pelo ID fornecido */
        $produto = Produtos::find($request->id);

        /* Atualiza nome se fornecido, senão mantém o atual */
        $name = $request->input("nome") ?? $produto->nome;

        /* Atualiza preço se fornecido, senão mantém o atual */
        $preco = $request->input("preco") ?? $produto->preco;

        /* Atualiza descrição se fornecida, senão mantém a atual */
        $description = $request->input('descrição') ?? $produto->descrição;

        /* Atualiza categoria se fornecida, senão mantém a atual */
        $categoria = $request->input('id_categoria') ?? $produto->id_categoria;

        /* Upload de nova imagem se fornecida */
        if ($request->file('imagem')) {
            $file = $request->file('imagem');
            /* Gera nome único para o novo arquivo */
            $fileName = date('dmYH') . '_' . $file->getClientOriginalName() . '.' . $file->getClientOriginalExtension();
            /* Move o arquivo para a pasta de produtos */
            $file->move(public_path('img/products'), $fileName);
        } else {
            /* Mantém a imagem atual se nenhuma nova foi enviada */
            $fileName = $produto->imagem;
        }

        /* Atualiza os campos do produto com os novos valores */
        $produto->nome = $name;
        $produto->preco = $preco;
        $produto->descrição = $description;
        $produto->id_categoria = $categoria;
        $produto->imagem = $fileName;

        /* Salva as alterações no banco de dados */
        $produto->save();
        
        /* Redireciona para a lista de produtos com mensagem de sucesso */
        return redirect()->route('admin.produtos')->with('sucesso', 'produto atualizado com sucesso!');
    }

}
