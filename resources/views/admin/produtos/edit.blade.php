<!-- Modal Structure -->
<div id="edit-{{ $produto->id }}" class="modal">
    <div class="modal-content">
        <h4><i class="material-icons">playlist_add_circle</i> Editar produto</h4>
        <form action="{{ route('admin.produto.update', $produto->id) }}" method="POST" enctype="multipart/form-data"
            class="col s12">
            @csrf
            @method('PUT')
            <input type="hidden" name="id_user" value="{{ auth()->user()->id }}">

            <div class="row">
                <div class="input-field col s6">
                    <input name="nome" id="nome" type="text" class="validate" placeholder="Nome"
                        value="{{ $produto->nome }}">
                    <label for="nome">Nome</label>
                </div>

                <div class="input-field col s6">
                    <input name="preco" id="preco" type="number" class="validate" placeholder="preço"
                        step="0.01" value="{{ $produto->preco }}">
                    <label for="preco">Preço</label>
                </div>

                <div class="input-field col s12">
                    <input name="descricao" id="descricao" type="text" class="validate" placeholder="descrição"
                        value="{{ $produto->descricao }}">
                    <label for="descricao">Descrição</label>
                </div>

                <!-- Select que vai pro back -->
                <div class="input-field col s12 hide">
                    <label for="id_categoria">Categoria</label>
                    <select class="browser-default" style="border-bottom-style:solid; border-width: 3px;"
                        name="id_categoria" id="id_categoria_hidden" required>
                        <option value="" disabled selected>Escolha uma opção</option>
                        @foreach ($categorias as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Select do front -->
                <div class="input-field col s12">
                    <select id="id_categoria_visivel">
                        @foreach ($categorias as $c)
                            <option value="{{ $c->id }}">{{ $c->name }}</option>
                        @endforeach
                    </select>
                    <label>Categoria</label>
                </div>

                <div>
                    <div class="btn">
                        <label for="file-{{ $produto->id }}">
                            <span class="text-white">
                                Adicionar Imagem
                            </span>
                        </label>
                    </div>
                    <input type="file" id="file-{{ $produto->id }}" name="imagem" accept=".png, .jpeg, .jpg"
                        class="hidden">
                    <div class="w-[100%] h-[150px] flex justify-center items-center mt-[20px]">
                        <div class=" bg-slate-400 h-[100%] w-[150px]  flex items-center justify-center">
                            <img class="w-[110px] h-[110px]" id="imagePreview-{{ $produto->id }}"
                                src="{{ $produto->imagem ? asset('img/products/' . $produto->imagem) : 'https://img.icons8.com/pastel-glyph/128/box--v3.png' }}">
                        </div>
                    </div>
                </div>

                <div>
                    <button type="submit" class="waves-effect waves-green btn green right">Salvar</button><br>
                </div>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const input = document.getElementById('file-{{ $produto->id }}');
            const preview = document.getElementById('imagePreview-{{ $produto->id }}');

            input.addEventListener('change', function(event) {
                console.log("Preview iniciado para produto {{ $produto->id }}");

                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();

                    reader.onload = function(e) {
                        preview.src = e.target.result;
                    };

                    reader.readAsDataURL(file);
                }
            });
            const selectVisivel = document.getElementById('id_categoria_visivel');
            const selectHidden = document.getElementById('id_categoria_hidden');

            // Atualiza o hidden quando o usuário muda o select visível
            selectVisivel.addEventListener('change', function() {
                selectHidden.value = selectVisivel.value;
            });

            // Opcional: deixar o select visível com o valor atual
            selectVisivel.value = "{{ $produto->id_categoria }}";
            selectHidden.value = "{{ $produto->id_categoria }}";
        });
    </script>
</div>
