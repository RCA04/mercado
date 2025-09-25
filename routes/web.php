<?php

/**
 * Arquivo de Rotas Web
 * 
 * Define todas as rotas da aplicação web, incluindo:
 * - Rotas de autenticação
 * - Rotas do site público
 * - Rotas administrativas
 * - Rotas do carrinho de compras
 */

use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\dashboardController;
use App\Http\Controllers\loginController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\TesteController;
use App\Http\Controllers\VendaController;
use App\Models\Vendas;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;
use LaravelQRCode\Facades\QRCode;




/*Route::get('/', function () {
    return Inertia::render('welcome');
})->name('home');
*/
/*Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('dashboard', function () {
        return Inertia::render('dashboard');
    })->name('dashboard');
});
*/
// Inclui arquivos de rotas específicas
require __DIR__ . '/settings.php';
require __DIR__ . '/auth.php';

/*Route::get('exemplo1', function(){ //cria uma nova rota
    return view('testesRota/exemplo-01');//callback(o que vai mostar na pagina)
}); Caso haja mais doque o view ou somente o view

Route::view('exemplo1',"testesRota/exemplo-01");//quando há somente o view 


Route::any('/any', function(){
    return "o tipo de rota any permite qualquer tipo de acesso http (put, delete, get, post)";
});

Route::match(["get","put"], "/match", function(){
    return "match aceita apenas os metodos passado a ele";
});

Route::get("/product/{id}/{cat}", function($id,$cat){
 return "o identificador do produte é:".$id. "<br>". "categoria do produto:". $cat;
});*/

/*Route::get("/product/{id}/{cat?}", function($id,$cat = ""){
    return "o identificador do produto é:".$id. "<br>". "categoria do produto:". $cat;
});/*os parametros passados na url ficam em {} e devem ser passados na função
quando tem {parametro?}, a função deve receber um valor default
assim não é necessario ela estar definida para que a página seja carregada*/

/*Route::get("/exemplo2", function(){
    return redirect("/exemplo1");
}); Sintaxe caso haja algo a mais na rota 

Route::redirect("exemplo2", "exemplo1");//modo simplificado com somente o redirect

//Rota nomeada
Route::get("/novidades", function(){
    return view("news");
})->name("noticias");
//Redirecionamento para a rota nomeada
Route::get("/news", function(){
    return redirect()->route("noticias");
});

//grupo de rotas
//agrupamento de rotas por prefixo
Route::prefix("admin")->group(function(){
    Route::get("dash",function(){
        return "dashboard";
    })->name('admin.dash');
    Route::get("cliente",function(){
        return "client";
    });
    Route::get("gerenciamento",function(){
        return "gerenciar";
    });
});

//Agrupamento de rotas pelo nome
Route::name("admin.")->group(function(){
    Route::get("admin/dash",function(){
        return "dashboard";
    })->name('admin.dash');
    Route::get("admin/cliente",function(){
        return "client";
    })->name('admin.cliente');
    Route::get("admin/gerenciamento",function(){
        return "gerenciar";
    })->name('admin.gerenciamento');
});

//agrupamento de rotas por nome e prefixo

//Agrupamento de rotas pelo nome
Route::group([
            'prefix' => 'admin',
            'as' => 'admin.'
],function(){
    Route::get("dash",function(){
        return "dashboard";
    })->name('dash');
    Route::get("admin/cliente",function(){
        return "client";
    })->name('cliente');
    Route::get("admin/gerenciamento",function(){
        return "gerenciar";
    })->name('gerenciamento');
});*/

/* ========================================
   ROTAS DE RECURSOS (CRUD)
   ======================================== */
/* 
 * ROTAS RESOURCE - Cria automaticamente todas as rotas CRUD
 * GET /produtos - Lista produtos (index)
 * GET /produtos/create - Formulário de criação (create)
 * POST /produtos - Salva novo produto (store)
 * GET /produtos/{id} - Mostra produto específico (show)
 * GET /produtos/{id}/edit - Formulário de edição (edit)
 * PUT/PATCH /produtos/{id} - Atualiza produto (update)
 * DELETE /produtos/{id} - Remove produto (destroy)
 */
Route::resource('produtos', ProdutoController::class);
Route::resource('users', UserController::class);

/* ========================================
   ROTAS DO SITE PÚBLICO (Autenticadas)
   ======================================== */
/* 
 * ROTA: Página inicial do site
 * FUNÇÃO: Mostra produtos em destaque
 * MIDDLEWARE: auth (usuário deve estar logado)
 */
Route::get('/inicio', [SiteController::class, 'index'])->name('site.index')->middleware('auth');

/* 
 * ROTA: Detalhes de um produto
 * FUNÇÃO: Mostra informações detalhadas de um produto
 * PARÂMETRO: {slug} - URL amigável do produto
 * MIDDLEWARE: auth (usuário deve estar logado)
 */
Route::get('/produto/{slug}', [SiteController::class, 'details'])->name('site.details')->middleware('auth');

/* 
 * ROTA: Produtos por categoria
 * FUNÇÃO: Lista produtos de uma categoria específica
 * PARÂMETRO: {id} - ID da categoria
 * MIDDLEWARE: auth (usuário deve estar logado)
 */
Route::get('/categoria/{id}', [SiteController::class, 'categoria'])->name('site.categoria')->middleware('auth');

/* ========================================
   ROTAS DO CARRINHO DE COMPRAS
   ======================================== */
/* 
 * ROTA: Visualizar carrinho
 * FUNÇÃO: Mostra todos os itens no carrinho
 * MIDDLEWARE: auth (usuário deve estar logado)
 */
Route::get('/carrinho', [CarrinhoController::class, 'carrinhoLista'])->name('site.carrinho')->middleware('auth');

/* 
 * ROTA: Adicionar produto ao carrinho
 * FUNÇÃO: Adiciona um produto ao carrinho de compras
 * MÉTODO: POST (envia dados do produto)
 */
Route::post('/carrinho', [CarrinhoController::class, 'adicionarCarrinho'])->name('site.addcarrinho');

/* 
 * ROTA: Remover produto do carrinho
 * FUNÇÃO: Remove um produto específico do carrinho
 * MÉTODO: POST (envia ID do produto)
 */
Route::post('/remove', [CarrinhoController::class, 'removeCarrinho'])->name('site.removecarrinho');

/* 
 * ROTA: Atualizar quantidade no carrinho
 * FUNÇÃO: Atualiza a quantidade de um produto no carrinho
 * MÉTODO: POST (envia ID e nova quantidade)
 */
Route::post('/atualizar', [CarrinhoController::class, 'atualizaCarrinho'])->name('site.atualizacarrinho');

/* 
 * ROTA: Limpar carrinho
 * FUNÇÃO: Remove todos os itens do carrinho
 * MÉTODO: GET (ação simples)
 */
Route::get('/limpar', [CarrinhoController::class, 'limpaCarrinho'])->name('site.limparcarrinho');

/* ========================================
   ROTAS DE DEMONSTRAÇÃO
   ======================================== */
/* 
 * ROTA: Gerar QR Code
 * FUNÇÃO: Gera um código QR para demonstração
 * RETORNA: Imagem PNG do QR Code
 */
Route::get('qr-code', function () {
    /* Gera QR Code com texto de demonstração */
    return QRCode::text('Este qr-code é para somente demonstração')->png();
})->name('qr-code');

/* ========================================
   ROTAS DE AUTENTICAÇÃO
   ======================================== */
/* 
 * ROTA: Página de login
 * FUNÇÃO: Exibe formulário de login
 * MÉTODO: GET (página inicial)
 */
Route::view('/', 'login.form')->name('login.form');

/* 
 * ROTA: Processar login
 * FUNÇÃO: Autentica o usuário no sistema
 * MÉTODO: POST (envia credenciais)
 */
Route::post('/auth', [loginController::class, 'auth'])->name('login.auth');

/* 
 * ROTA: Logout
 * FUNÇÃO: Desconecta o usuário do sistema
 * MÉTODO: GET (ação simples)
 */
Route::get('/logout', [loginController::class, 'logout'])->name('login.logout');

/* 
 * ROTA: Página de registro
 * FUNÇÃO: Exibe formulário de cadastro
 * MÉTODO: GET
 */
Route::get('/register', [loginController::class, 'create'])->name('login.create');

/* ========================================
   ROTAS DE PERFIL DO USUÁRIO
   ======================================== */
/* 
 * ROTA: Visualizar perfil
 * FUNÇÃO: Mostra informações do perfil do usuário
 * MIDDLEWARE: auth (usuário deve estar logado)
 */
Route::get('/perfil', [profileController::class, 'index'])->name('profile.view')->middleware('auth');

/* 
 * ROTA: Editar perfil
 * FUNÇÃO: Exibe formulário de edição do perfil
 * MIDDLEWARE: auth (usuário deve estar logado)
 */
Route::get('/perfil/editor', [profileController::class, 'edit'])->name('profile.edit')->middleware('auth');

/* 
 * ROTA: Atualizar perfil
 * FUNÇÃO: Salva alterações no perfil do usuário
 * MÉTODO: PUT (atualização de dados)
 * MIDDLEWARE: auth (usuário deve estar logado)
 */
Route::put('/perfil/update', [profileController::class, 'update'])->name('profile.update')->middleware('auth');

/* ========================================
   ROTAS ADMINISTRATIVAS
   ======================================== */

/* 
 * ROTA: Dashboard administrativo
 * FUNÇÃO: Página principal do painel administrativo
 * MIDDLEWARE: auth (usuário deve estar logado)
 */
Route::get('/admin/dashboard', [dashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

/* 
 * ROTAS: Gerenciamento de produtos
 * FUNÇÃO: CRUD completo de produtos no painel admin
 */
Route::get('/admin/produtos', [ProdutoController::class, 'index'])->name('admin.produtos')->middleware('auth');
Route::delete('/admin/produto/delete/{id}', [ProdutoController::class, 'destroy'])->name('admin.produto.delete')->middleware('auth');
Route::put('/admin/produto/update/{id}', [ProdutoController::class, 'update'])->name('admin.produto.update')->middleware('auth');
Route::post('/admin/produto/store', [ProdutoController::class, 'store'])->name('admin.produto.store')->middleware('auth');

/* 
 * ROTAS: Gerenciamento de categorias
 * FUNÇÃO: CRUD completo de categorias no painel admin
 */
Route::get('/admin/categorias', [CategoriaController::class, 'index'])->name('admin.categorias')->middleware('auth');
Route::delete('/admin/categoria/delete/{id}', [CategoriaController::class, 'destroy'])->name('admin.categoria.delete')->middleware('auth');
Route::put('/admin/categoria/update/{id}', [CategoriaController::class, 'update'])->name('admin.categoria.update')->middleware('auth');
Route::post('/admin/categoria/store', [CategoriaController::class, 'store'])->name('admin.categoria.store')->middleware('auth');

/* 
 * ROTAS: Gerenciamento de usuários
 * FUNÇÃO: Listar e gerenciar usuários do sistema
 */
Route::get('/admin/usuarios', [UserController::class, 'show'])->name('admin.usuarios')->middleware('auth');
Route::delete('/admin/usuario/{id}', [UserController::class, 'destroy'])->name('admin.usuario.delete')->middleware('auth');

/* 
 * ROTAS: Gerenciamento de pedidos/vendas
 * FUNÇÃO: Visualizar pedidos e processar pagamentos
 */
Route::get('/admin/pedidos', [VendaController::class, 'index'])->name('admin.pedidos')->middleware('auth');
Route::post('/pagamento', [VendaController::class, 'store'])->name('registrar.pagamento')->middleware('auth');
