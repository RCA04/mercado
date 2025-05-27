<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Produtos;
class AuthServiceProvider extends ServiceProvider
{
    /**
     * As políticas de mapeamento para a aplicação.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //'App\Models\Produtos'=> 'App\Policies\ProdutoPolicy'
    ];

    /**
     * Registre quaisquer serviços de autenticação/autorização.
     */
    public function boot(): void
    {
        //  $this->registerPolicies();
        //gate simples
        // Gate::define("ver-produto", function (User $user, Produtos $produtos) {
        // });
        //policy
        // Gate::define('ver-produto', function (User $user, Produtos $produto){
        //    return $user->id === $produto->id_user;  
        // });
    }
}
