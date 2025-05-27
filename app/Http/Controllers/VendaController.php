<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendas;
use Joelwmale\Cart\Facades\Cart;

class VendaController extends Controller
{


    public function index(Request $request)
    {
        $vendas = Vendas::where('id_user', auth()->id())->paginate(5); // 🔒 Só produtos do usuário logado


        $search = $request->query('search');


        foreach ($vendas as $venda) {
            $venda->items = json_decode($venda->items ?? '[]');
        }



        return view("admin.pedidos", compact('vendas'));
    }

    public function show(Request $request)
    {

        $vendas = auth()->user()->vendas ?? collect();

        return view("admin.dashboard", compact("vendas"));

    }

    public function store(Request $request)
    {
        $venda = $request->all();
        $itemsBrutos = $request->items ?? [];
        $items = [];

        foreach ($itemsBrutos as $itemJson) {
            $items[] = json_decode($itemJson, true);
        }


        $validate = $request->validate([
            'valor' => 'required|numeric',
        ]);

        $venda = Vendas::create([
            'valor' => $request->valor,
            'pedido' => $request->pedido,
            'items' => json_encode($items),
            'id_user' => auth()->user()->id,
        ]);

        \Cart::clear();
        return redirect()->route('site.index')->with('sucesso', 'Parabéns pela compra');
    }


}
