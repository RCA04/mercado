   <!-- Modal Structure -->
   <div id="create" class="modal">
       <div class="modal-content">
           <h4><i class="material-icons">playlist_add_circle</i> Novo produto</h4>
           <form action="{{ route('admin.produto.store') }}" method="POST" enctype="multipart/form-data" class="col s12">
               @csrf

               <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

               <div class="row">
                   <div class="input-field col s6">
                       <input name="nome" id="nome" type="text" class="validate">
                       <label for="nome">Nome</label>
                   </div>
                   <div class="input-field col s6">
                       <input name="preco" id="preco" type="number" class="validate" step='0.01'>
                       <label for="preco">Preço</label>
                   </div>

                   <div class="input-field col s12">
                       <input name="descrição" id="descrição" type="text" class="validate">
                       <label for="descrição">Descrição</label>
                   </div>

                   <div class="input-field col s12">
                       <select name="id_categoria" required>
                           <option value="" disabled selected>Escolha uma opção</option>
                           @foreach ($categorias as $c)
                               <option value="{{ $c->id }}">{{ $c->name }}</option>
                           @endforeach
                       </select>
                       <label>Categoria</label>
                   </div>
                   <div class="inline-flex items-center">
                       <div class="btn">
                           <label for="file">
                               <span class="text-white">
                                   Adicionar Imagem
                               </span>
                           </label>
                       </div>
                   </div>
                   <input type="file" id="file" name="imagem" accept=".png, .jpeg, .jpg" class="hidden">
                   <div class="w-[100%] h-[150px] flex justify-center items-center mt-[20px]">
                       <div id="imagePreviewContainer"
                           class="bg-slate-400 h-[100%] w-[150px] hidden items-center justify-center">
                           <img id="imagePreview" class="hidden w-[110px] h-[100px]">
                       </div>
                   </div>


               </div>
               <div>
                   <button type="submit" class=" waves-effect waves-green btn green right">Cadastrar</button><br>
               </div>
           </form>
       </div>

       <script>
           document.addEventListener('DOMContentLoaded', function() {
               const input = document.getElementById('file');
               const preview = document.getElementById('imagePreview');
               const containerPrev = document.getElementById('imagePreviewContainer')
               input.addEventListener('change', function(event) {

                   const file = event.target.files[0];
                   if (file) {
                       const reader = new FileReader();

                       reader.onload = function(e) {
                           containerPrev.classList.remove('hidden');
                           containerPrev.style.display = 'flex';
                           preview.src = e.target.result;
                           preview.classList.remove('hidden');
                           preview.style.display = 'block'; // Garante que apareça
                       };

                       reader.readAsDataURL(file);
                   }
               });
           });
       </script>

   </div>
