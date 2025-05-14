<div id="pagamento" class="modal">
    <div class="modal-content">
                <h6 class="inline-flex justify-center w-full" >Segue seu QR-Code para pagamento via pix</h6>
        
        <div class="row inline-flex justify-center w-full mt-[5px] mb-[5px] ">
            <div class="border-2">
            <img class="w-80 " src="{{ route( 'qr-code') }}">
            </div>

            </div>
            <span class="inline-flex justify-center w-full" >Valor: R$ {{ number_format(\Cart::getTotal(), 2 , ',', '.')}}</h5></span>

        
            <div class="block">
            <a href="#!" class="modal-close waves-effect waves-green btn blue right ml-[5px]">Cancelar</a>
            <form action="{{ route('registrar.pagamento') }}" method="POST">
            @csrf 
            <button type="submit" name="valor" value="{{ \Cart::getTotal()}}" class=" waves-effect waves-green btn red right ">Pago</button><br>
            </form>
            </div>
    
    </div>
</div>
