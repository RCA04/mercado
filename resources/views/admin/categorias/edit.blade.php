<!-- Modal Structure -->
<div id="edit-{{$categoria->id}}" class="modal">
  <div class="modal-content">
    <h4><i class="material-icons">playlist_add_circle</i> Editar Categoria</h4>
    <form action="{{route('admin.categoria.update', $categoria->id)}}" method="POST" enctype="multipart/form-data" class="col s12">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="input-field col s6" style="width:100%">
          <input name="name" id="name" type="text" class="validate" placeholder="{{$categoria->name}}">
          <label for="name">Nome</label>
        </div>
        <div class="input-field col s12">
          <input name="descricao" id="descricao" type="text" class="validate" placeholder="{{$categoria->descricao}}">
          <label for="descricao">Descrição</label>
        </div>

      </div>
      </div> 
      
      <div class="w-full inline-flex justify-center mb-1">
        <button type="submit" class="waves-effect waves-green btn green w-[90%]">Salvar</button><br>
      </div> 
    </form>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Inicializa o select
      var elems = document.querySelectorAll('select');
      M.FormSelect.init(elems);
    });
  </script>
</div>
