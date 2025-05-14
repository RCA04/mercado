<style>
    @keyframes fadeOut {
        0% {
            opacity: 1;
            transform: translateY(0);
        }
        100% {
            opacity: 0;
            transform: translateY(-20px);
        }
    }
    .fade-out {
        animation: fadeOut 1.5s ease-out  forwards;
    }


</style>

@if ($messagem = Session::get('sucesso'))
<div id="positivo" class="card-panel green">
  {{$messagem }}
</div>
@endif

<script>
      document.addEventListener('DOMContentLoaded', function() {

       setTimeout(function() {
        var card = document.getElementById('positivo');
        if(card) {
            card.classList.add('fade-out');
            setTimeout(function(){
                card.style.display = 'none'
          },900);
        }
      }, 3500);
      
    });

</script>
