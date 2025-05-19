@extends('admin.layout')
@section('titulo', 'Usuários')
@section('conteudo')

    <div class="row container crud">


        <div class="row titulo ">
            <h1 class="left">Pedidos</h1>
            <span class="right chip">pedidos nessa pagina {{ $vendas->count() }}</span>
        </div>

        <div class="card z-depth-4 registros">
            @include('admin.includes.mensagens')
            <table class="striped ">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Código do Pedido</th>
                        <th>Valor total</th>
                        <th>Comprado em</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($vendas as $venda)
                        <tr>
                            <td>#{{ $venda->id }}</td>
                            <td>{{ $venda->pedido }}</td>
                            <td>{{ $venda->valor }}</td>
                            <td>{{ date('d-m-Y', strtotime($venda->created_at)) }}</td>
                            <td>
                                <a href="#view-{{ $venda->id }}"
                                    class="btn-floating modal-trigger  waves-effect waves-light red">
                                    <i class="material-icons">visibility</i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class= "row center">
            {{ $vendas->appends(['search' => request('search')])->links('custom.pagination') }}
        </div>
        @foreach ($vendas as $venda)
            @include('admin.vendaDetail.details')
        @endforeach
    </div>
@endsection
