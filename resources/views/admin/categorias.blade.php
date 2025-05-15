@extends('admin.layout')
@section('titulo', 'Categorias')
@section('conteudo')

   <div class="fixed-action-btn">
    <a  class="btn-floating btn-large bg-gradient-green modal-trigger"href="#create">
     <i class="large material-icons">add</i>
    </a>   
  </div>


  @include('admin.categorias.create')

    <div class="row container crud">

        
            <div class="row titulo ">              
              <h1 class="left">Categorias</h1>
              <span class="right chip">{{ $categorias->count()}} Categorias exibidas nessa pagina</span>  
            </div>

           <nav class="bg-gradient-blue">
            <div class="nav-wrapper">
              <form method="GET" action="{{ route('admin.categorias') }}">
                <div class="input-field">
                    <input placeholder="Pesquisar..." id="search" name="search" type="search" required>
                    <label class="label-icon" for="search"><i class="material-icons">search</i></label>
                    <i class="material-icons" id="deletar">clear</i>
                </div>              
              </form>
            </div>
          </nav>     

            <div class="card z-depth-4 registros" >
            @include('admin.includes.mensagens')
            <table class="striped ">
                <thead>
                  <tr>
                    <th>ID</th>  
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th></th>
                    <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($categorias as $categoria )
                      <tr>
                        <td>#{{$categoria->id}}</td>
                        <td>{{$categoria->name}}</td>                    
                        <td>{{$categoria->descricao}}</td>
                        <td>
                           <a href="#edit-{{ $categoria->id }}" class="btn-floating modal-trigger  waves-effect waves-light orange">
                            <i class="material-icons">mode_edit</i>
                          </a>                          
                      </td>
                      <td>
                        <a href="#delete-{{ $categoria->id }}" class="btn-floating modal-trigger waves-effect waves-light red"><i class="material-icons">delete</i></a>

                      </td>
                          @include('admin.categorias.edit',['categoria' => $categoria])
                          @include('admin.categorias.delete')
                    </tr>
                    @endforeach
                  </tr>
                </tbody>
              </table>
            </div> 

            <div class= "row center">
              {{ $categorias->appends(['search' => request('search')])->links('custom.pagination') }}
            </div>       
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
    const clearIcon = document.getElementById('deletar');
    const searchInput = document.getElementById('search');

    clearIcon.addEventListener('click', function () {
      searchInput.value = '';
      window.location.href = "{{ route('admin.categorias') }}"; 
    });
  });

</script>
@endsection