@extends('admin.layout')
@section('title', "Carrinho")
@section('conteudo')

<style>
    @keyframes fadeOut {
        0% {
            opacity: 1;
            transform: translateY(0);
        }
        100% {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
    .fade-out {
        animation: fadeOut 1.5s ease-out  forwards;
    }


</style>

<div class="row container">

  @if ($messagem = Session::get('sucesso'))
<div id="positivo" class="card-panel green">
  {{$messagem }}
</div>
@endif

    @if ($messagem = Session::get('aviso'))
    <div id="aviso" class="card-panel blue">
      {{$messagem }}
    </div>
    @endif

    @if($itens->count() == 0 ) 
    <div class="card orange">
      <div class ="card-content white-text">
          <span class ="card-title"> seu carrinho está vazio </span>
          <p>Aproveite nossas promoções!</p>
      </div>
    </div>

    @else

    <h3>Seu Carrinho contém {{ $itens->count() }} produtos. </h3>
    <table class="striped"> 
        <thead>
            <tr>
                <th></th> 
                <th>Nome</th>
                <th>Preço</th>
                <th>Quantidade</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ( $itens as $item )
            <tr>
            <td>              
            <img src="{{ $item->attributes->image }}" alt="{{ $item->name }}" alt="" width="70" class="responsive-img circle" ></td>

            <td>{{$item->name}}</td>
            <td>RS: {{ number_format($item->price, 2 , ',', '.')}}</td>
            
            {{-- Botão atualizar --}}
            <form action="{{ route('site.atualizacarrinho') }}" method="POST" enctype="multipart/form-data">
              @csrf
              <td>
                <input type="hidden" name="id" value={{ $item->id }}>
                <input style="width: 40px; font-weight:900;" class="white center" min="1" type="number" name="quantity" value="{{$item->quantity}}"></td>
            <td>
                <button class="btn-floating  waves-effect waves-light orange"><i class="material-icons">refresh</i></button>
            
              </form>
                 {{-- Botão de remover --}}
                <form action="{{ route('site.removecarrinho') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <input type="hidden" name="id" value="{{ $item->id }}">
                <button class="btn-floating  waves-effect waves-light red"><i class="material-icons">delete</i></button>
                </form>
              </td>
          </tr>
          
          @endforeach
        </tbody>
      </table>
      <h5> Valor total: 

      <div class="card orange">
        <div class ="card-content white-text">
            <span class ="card-title">R$ {{ number_format(\Cart::getTotal(), 2 , ',', '.')}}</h5></span>
            <span>Pagamento somente via pix!</span>
        </div>
      </div>
  


    @endif
      <div class= "row container center">
        <a href="{{ route('site.index') }}" class="btn  waves-effect waves-light blue">continuar comprando<i class="material-icons" right>arrow_back</i></a>
        <a  href="{{ route('site.limparcarrinho') }}" class="btn  waves-effect waves-light blue">Limpar carrinho<i class="material-icons">clear</i></a>
        <a href="#pagamento" class="btn  waves-effect waves-light green modal-trigger">finalizar pedido<i class="material-icons">check</i></a>
      </div>
      @include('site.pagamento')
</div>

<script>
      document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
        var card = document.getElementById('aviso');
        if(card) {
            card.classList.add('fade-out');
            setTimeout(function(){
                card.style.display = 'none'
          },900);
        }
      }, 3500);

       setTimeout(function() {
        var card = document.getElementById('positivo');
        if(card) {
            card.classList.add('fade-out');
            setTimeout(function(){
                card.style.display = 'none'
          },900);
        }
      }, 3500);
      
    });

</script>

@endsection