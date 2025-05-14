      @extends('admin.layout')
      @section('titulo','Dashboard')

      @section('conteudo')


    <div class="row container">
      <section class="info">

        <div class="col s12 m4">
        <article class="bg-gradient-green card z-depth-4 ">
          <i class="material-icons">paid</i>
          <p>Faturamento</p>
          <h3>R$ {{ number_format($vendas->sum('valor'), 2, ',', '.') }}</h3>       
        </article>
        </div>

        <div class="col s12 m4">
          <article class="bg-gradient-blue card z-depth-4 ">
            <i class="material-icons">face</i>
            <p>Usuários</p>
            <h3>{{ $usuarios }} </h3>           
          </article>
          </div>

          <div class="col s12 m4">
            <article class="bg-gradient-orange card z-depth-4 ">
              <i class="material-icons">shopping_cart</i>
              <p>Pedidos este mês</p>
              <h3>{{$vendas->count()}}</h3>            
            </article>
            </div>

      </section>        
    </div>


        <div class="row container ">
            <section class="graficos col s12 m6" >            
              <div class="grafico card z-depth-4">
                  <h5 class="center"> Aquisição de usuários</h5>
                  <canvas id="myChart" width="400" height="200"></canvas>
              </div>           
            </section> 
            
            <section class="graficos col s12 m6">            
                <div class="grafico card z-depth-4">
                    <h5 class="center"> Produtos </h5>
                <canvas id="myChart2" width="400" height="200"></canvas> 
            </div>            
           </section>             
        </div>

     


        </div>



@endsection 

@push('graficos')
<script>

function gerarCorAleatoria() {
    const r = Math.floor(Math.random() * 256);  // Valor aleatório para o vermelho (0-255)
    const g = Math.floor(Math.random() * 256);  // Valor aleatório para o verde (0-255)
    const b = Math.floor(Math.random() * 256);  // Valor aleatório para o azul (0-255)
    
    return `rgba(${r}, ${g}, ${b}, 1)`;  // Retorna a cor no formato 'rgba(r, g, b, a)'
}

const coresAleatorias = Array.from({ length: 100 }, () => gerarCorAleatoria());



/* Gráfico 01 */
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [{{ $userAno }}],
        datasets: [{
            label: [{!! $userLabel   !!}],
            data: [{{ $userTotal }}],
            backgroundColor: coresAleatorias,
            borderColor: coresAleatorias,
             borderWidth: 1, 
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

/* Gráfico 02 */

    var ctx = document.getElementById('myChart2');
    var myChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels:[{!! $catLabel !!}],
            datasets: [{
                label: 'Visitas',
                data: [{{ $catTotal }}],
                backgroundColor: coresAleatorias 
            }]
        }
    });
</script>
@endpush    