<div id="view-{{ $venda->id }}" class="modal">
    <div class="modal-content">


        <div class="row titulo ">
            <h1 class="left">Pedido: {{ $venda->pedido }}</h1>
        </div>

        <div class="card z-depth-4 registros">
            <table class="striped ">
                <thead>
                    <tr>
                        <th>Produto</th>
                        <th>Quantidade</th>
                        <th>Valor unitário</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($venda->items as $item)
                        <tr>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>R$ {{ $item->price }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
