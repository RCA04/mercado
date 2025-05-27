   <!-- Modal Structure -->
   <div id="create" class="modal">
    <div class="modal-content">
      <h4><i class="material-icons">playlist_add_circle</i> Nova Categoria</h4>
      <form action="{{route('admin.categoria.store')  }}" method="POST" enctype="multipart/form-data"  class="col s12" >
        @csrf

        <div class="row">
          <div class="input-field col s6" style="width:100%">
            <input name="name" id="name" type="text" class="validate">
            <label for="name">Nome</label>
          </div>

          <div class="input-field col s12">
            <input name="descricao" id="descricao" type="text" class="validate">
            <label for="descricao">Descrição</label>
          </div>
          </div>

        </div> 
       <div class="w-full inline-flex justify-center mb-1">
        <button type="submit" class=" waves-effect waves-green btn green w-[90%]">Criar</button><br>
       </div> 
      </form>
      </div>

</div>