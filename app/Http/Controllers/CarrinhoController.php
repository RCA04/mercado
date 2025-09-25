<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Joelwmale\Cart\Facades\Cart;
use App\Routes\web;

/**
 * Controlador do Carrinho de Compras
 * 
 * Gerencia todas as operações relacionadas ao carrinho de compras:
 * - Listar itens do carrinho
 * - Adicionar produtos ao carrinho
 * - Remover produtos do carrinho
 * - Atualizar quantidades
 * - Limpar carrinho
 */
class CarrinhoController extends Controller
{
    /* 
     * MÉTODO: carrinhoLista()
     * FUNÇÃO: Exibe todos os itens que estão no carrinho de compras
     * RETORNA: View com a lista de produtos no carrinho
     */
    public function carrinhoLista()
    {
        /* Busca todos os itens que estão armazenados no carrinho */
        $itens = \Cart::getContent();
        
        /* Retorna a view do carrinho passando os itens para exibição */
        return view('site.carrinho', compact('itens'));
    }

    /* 
     * MÉTODO: adicionarCarrinho()
     * FUNÇÃO: Adiciona um produto ao carrinho de compras
     * PARÂMETROS: Request com dados do produto (id, nome, preço, quantidade, imagem)
     * RETORNA: Redirecionamento para o carrinho com mensagem de sucesso
     */
    public function adicionarCarrinho(Request $request)
    {
        /* Adiciona o produto ao carrinho usando a biblioteca Laravel Cart */
        \Cart::add([
            'id' => $request->id,                    /* ID único do produto */
            'name' => $request->name,                /* Nome do produto */
            'price' => $request->price,              /* Preço do produto */
            'quantity' => abs($request->quantity),   /* Quantidade (abs() garante que seja positiva) */
            'attributes' => array(                   /* Atributos extras do produto */
                'image' => $request->image           /* Caminho da imagem do produto */
            )
        ]);

        /* Redireciona para a página do carrinho com mensagem de sucesso */
        return redirect()->route('site.carrinho')->with('sucesso', 'Item adicionado ao seu carrinho');
    }

    /* 
     * MÉTODO: removeCarrinho()
     * FUNÇÃO: Remove um produto específico do carrinho
     * PARÂMETROS: Request contendo o ID do produto a ser removido
     * RETORNA: Redirecionamento para o carrinho com mensagem de sucesso
     */
    public function removeCarrinho(Request $request)
    {
        /* Remove o produto do carrinho usando o ID fornecido */
        \Cart::remove($request->id);
        
        /* Redireciona para o carrinho com mensagem de sucesso */
        return redirect()->route('site.carrinho')->with('sucesso', 'Item removido de seu carrinho');
    }

    /* 
     * MÉTODO: atualizaCarrinho()
     * FUNÇÃO: Atualiza a quantidade de um produto no carrinho
     * PARÂMETROS: Request com ID do produto e nova quantidade
     * RETORNA: Redirecionamento para o carrinho com mensagem de sucesso
     */
    public function atualizaCarrinho(Request $request)
    {
        /* Atualiza a quantidade do produto no carrinho */
        \Cart::update($request->id, [
            'quantity' => [
                'relative' => false,              /* Atualização absoluta (não relativa) */
                'value' => abs($request->quantity) /* Nova quantidade (abs() garante valor positivo) */
            ],
        ]);
        
        /* Redireciona para o carrinho com mensagem de sucesso */
        return redirect()->route('site.carrinho')->with('sucesso', 'Item atualizado com Sucesso!!');
    }

    /* 
     * MÉTODO: limpaCarrinho()
     * FUNÇÃO: Remove todos os itens do carrinho de compras
     * RETORNA: Redirecionamento para o carrinho com mensagem de aviso
     */
    public function limpaCarrinho()
    {
        /* Remove todos os itens do carrinho */
        \Cart::clear();
        
        /* Redireciona para o carrinho com mensagem de aviso */
        return redirect()->route('site.carrinho')->with('aviso', 'seu Carrinho está vazio!');
    }
}