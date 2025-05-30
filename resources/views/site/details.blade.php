@extends('admin.layout')
@section('title', "Detalhes")
@section('conteudo')

<div class="row container ">
    <div class = "col s12 m6" >
        <img src="{{ $produto->imagem ? asset('img/products/' . $produto->imagem) :  'https://img.icons8.com/pastel-glyph/128/box--v3.png'}}"
         class="responsive-img w-[100%] mt-1.5">
    </div>

    <div class= "col s12 m6">
        <h3>{{$produto->nome}}</h3>
        <h3>R$ {{ number_format($produto->preco, 2 , ',', '.')}}</h3>
        <p>{{$produto->descricao}}</p>
        <p>postado por: {{$produto->user->name}} <br>
            Categoria: {{$produto->categoria->name}}
        </p>
        <form action="{{ route('site.addcarrinho') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $produto->id }}">
            <input type="hidden" name="name" value="{{ $produto->nome }}">
            <input type="hidden" name="price" value="{{ $produto->preco }}">
            <input type="number" min="1" name="quantity" value="1">
            <input type="hidden" name="image" value="{{ $produto->imagem ? asset('img/products/' . $produto->imagem) :  'https://img.icons8.com/pastel-glyph/128/box--v3.png'}}">
            <button class= "btn orange  btn-large" type="submit">Comprar</button>
        </form>
    </div>

</div>

@endsection