
<div id="delete-{{ $categoria->id }}" class="modal">
    <div class="modal-content">
        <h4><i class="material-icons">delete</i>Tem certeza?</h4>
            <div class="row">
        
            <p>tem certeza que deseja excluir {{$categoria->name}}</p>


            </div>
        
            <a href="#!" class="modal-close waves-effect waves-green btn blue right ml-[5px]">Cancelar</a>
            
            <form action="{{ route('admin.categoria.delete', $categoria->id) }}" method="POST">
            @method('DELETE')
            @csrf   
            <button type="submit" class=" waves-effect waves-green btn red right ">Excluir</button><br>
            </form>
    
    </div>
</div>
