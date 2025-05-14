<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendas;
use Joelwmale\Cart\Facades\Cart;

class VendaController extends Controller
{

    public function index(Request $request){

        $vendas = auth()->user()->vendas ?? collect();

        return view("admin.dashboard",compact("vendas"));

    }

        public function store(Request $request){
            $venda = $request->all();

            $validate= $request->validate([
                'valor' =>'required|numeric',
            ]);

            $venda = Vendas::create([
                'valor'=> $request->valor,
                'id_user' => auth()->user()->id,
            ]);
            \Cart::clear();

            return redirect()->route('site.index')->with('sucesso','Parabéns pela compra');
        }


}
