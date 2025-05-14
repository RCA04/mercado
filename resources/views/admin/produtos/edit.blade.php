
<!-- Modal Structure -->
<div id="edit-{{$produto->id}}" class="modal">
  <div class="modal-content">
    <h4><i class="material-icons">playlist_add_circle</i> Editar produto</h4>
    <form action="{{route('admin.produto.update', $produto->id)}}" method="POST" enctype="multipart/form-data" class="col s12">
      @csrf
      @method('PUT')
      <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

      <div class="row">
        <div class="input-field col s6">
          <input name="nome" id="nome" type="text" class="validate" placeholder="{{$produto->nome}}">
          <label for="nome">Nome</label>
        </div>
        <div class="input-field col s6">
          <input name="preco" id="preco" type="number" class="validate" placeholder="{{$produto->preco}}">
          <label for="preco">Preço</label>
        </div>

        <div class="input-field col s12">
          <input name="descrição" id="descrição" type="text" class="validate" placeholder="{{$produto->descrição}}">
          <label for="descrição">Descrição</label>
        </div>
          <!--Select que vai pro beck-->
        <div class="input-field col s12 hidden">
     <label for="id_categoria">Categoria</label>
    <select class="browser-default"
    style="border-bottom-style:solid; border-width: 3px;"
    name="id_categoria" id="id_categoria_hidden" required>
      <option value="" disabled selected>Escolha uma opção</option>
      @foreach ($categorias as $c)
        <option value="{{ $c->id }}">{{ $c->name }}</option>
      @endforeach
    </select> 
          </div>
          <!--Select do front-->

              <div class="input-field col s12">
            <select id="id_categoria_visivel" required>
              <option value=""  disabled selected>{{$produto->categoria->name}}</option>
              @foreach ($categorias as $c )
              <option value="{{ $c->id }}">{{$c->name}}</option>
              @endforeach
            </select>
            <label>Categoria</label>
          </div> 

        <div class="inline-flex items-center">
          <div class="btn">
            <label for="file">
              <span class="text-white">Adicionar Imagem</span>
            </label>
          </div>
          <div class="file-path-wrapper pl-[5px] border-r-2 border-b-2 border-t-2 rounded-r-xl border-slate-100 border-b-slate-300 block h-[36px]">
            <input type="file" id="file" name="imagem" accept=".png, .jpeg, .jpg" value="imagem">
          </div>
        </div>
      </div> 
      
      <div>
        <button type="submit" class="waves-effect waves-green btn green right">Salvar</button><br>
      </div> 
    </form>
  </div>

   <script>
    document.addEventListener('DOMContentLoaded', function () {
      const visibleSelect = document.getElementById('id_categoria_visivel');
      const hiddenSelect = document.getElementById('id_categoria_hidden');

      if (visibleSelect && hiddenSelect) {
        visibleSelect.addEventListener('change', function () {
          hiddenSelect.value = this.value;
        });
      }
    });
  </script>
</div>
