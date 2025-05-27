@extends('admin.layout')
@section('titulo', 'Usuários')
@section('conteudo')

    <div class="row container crud">

        
            <div class="row titulo ">              
              <h1 class="left">Usuários</h1>
              <span class="right chip">{{ $users->count()}} usuários exibidos nessa pagina</span>  
            </div>

           <nav class="bg-gradient-blue">
            <div class="nav-wrapper">
              <form method="GET" action="{{ route('admin.usuarios') }}">
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
                    <th></th>
                    <th>ID</th>  
                    <th></th>
                    <th>Nome</th>
                    <th>Email</th>
                      <th>Data de criação</th>
                      <th></th>
                  </tr>
                </thead>
        
                <tbody>
                  @foreach ($users as $user )
                      <tr>
                        <td></td>
                        <td>#{{$user->id}}</td>
                        <td>
                        <img
                        src="{{ auth()->user()->photo ? asset('img/profiles/' . auth()->user()->photo) : 'https://img.icons8.com/fluency-systems-filled/48/user.png'}}"
                        class="w-[65px] h-[65px] rounded-full shadow-sm/70"
                        style=" border: 2px solid; border-color: #d9d9d9;"
                        />
                        </td>
                        <td>{{$user->name}}</td>                    
                        <td>{{$user->email}}</td>                    
                        <td>{{$user->created_at}}</td>
                        <td>
                          <a href="#delete-{{ $user->id }}" class="btn-floating modal-trigger
                           waves-effect waves-light red"><i class="material-icons">delete</i></a>
                      </td>
                          @include('admin.usuario.delete')
                    </tr>
                    @endforeach
                  </tr>
                </tbody>
              </table>
            </div> 

            <div class= "row center">
              {{ $users->appends(['search' => request('search')])->links('custom.pagination') }}
            </div>       
    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function () {
    const clearIcon = document.getElementById('deletar');
    const searchInput = document.getElementById('search');

    clearIcon.addEventListener('click', function () {
      searchInput.value = '';
      window.location.href = "{{ route('admin.usuarios') }}"; 
    });
   

  });

</script>
@endsection