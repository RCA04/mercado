<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
     {
         $search = $request->query('search');

         $categorias = Categoria::when($search, function($query) use ($search) {
                 $query->where('name', 'like', "%{$search}%");
             })
             ->paginate(5);
    
        return view('admin.categorias', compact('categorias', 'search'));            
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categorias = $request->all();

        $validate= $request->validate([
            'name' =>'required|string',
            'descricao'=>'required|string',
        ]);
     


        $categorias = Categoria::create([
            'name'=> $request->name,
            'descricao'=> $request->descricao
        ]);
       
        return redirect()->route('admin.categorias')->with('sucesso', 'Categoria cadastrada com sucesso');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $categoria = Categoria::find($request->id);

        $name = $request->input("name");
       
        if($name == null){
            $name = $categoria->name;
        }
       

        $description = $request->input('descricao');
       
        if($description == null){
            $description = $categoria->descricao;
        }

       
        $categoria->name =  $name;
        $categoria->descricao = $description;       
        $categoria->save();
       
        return redirect()->route('admin.categorias')->with('sucesso', 'Categoria atualizada com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
    
            $categorias=Categoria::find($id);
            $categorias->delete();
            return redirect()->route('admin.categorias')->with('sucesso', 'Categoria removida com sucesso!');
    
    }

        /**
     * Remove the specified resource from storage.
     */
}
