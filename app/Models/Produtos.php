<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Modelo Produtos
 * 
 * Representa um produto no sistema de e-commerce.
 * Gerencia os dados dos produtos e seus relacionamentos.
 * 
 * @property int $id
 * @property string $nome Nome do produto
 * @property string $descrição Descrição detalhada do produto
 * @property float $preco Preço do produto
 * @property string $imagem Caminho da imagem do produto
 * @property string $slug URL amigável do produto
 * @property int $id_categoria ID da categoria do produto
 * @property int $id_user ID do usuário que criou o produto
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Produtos extends Model
{
    use HasFactory;

    /* 
     * CAMPOS FILLABLE - Campos que podem ser preenchidos em massa
     * Define quais campos podem ser preenchidos usando create() ou fill()
     */
    protected $fillable = [
        'nome',           /* Nome do produto */
        'descrição',      /* Descrição detalhada */
        'preco',          /* Preço do produto */
        'imagem',         /* Caminho da imagem */
        'slug',           /* URL amigável */
        'id_categoria',   /* ID da categoria */
        'id_user',        /* ID do usuário que criou */
    ];

    /* 
     * NOME DA TABELA - Define o nome da tabela no banco de dados
     * Por padrão o Laravel usa o nome da classe em minúsculo + 's'
     */
    protected $table = "produtos";

    /* 
     * RELACIONAMENTO: Produto pertence a um usuário
     * Um produto é criado por um usuário específico
     * RETORNA: Relacionamento belongsTo com a tabela users
     */
    public function user()
    {
        /* Retorna o usuário que criou este produto */
        return $this->belongsTo(User::class, "id_user");
    }

    /* 
     * RELACIONAMENTO: Produto pertence a uma categoria
     * Cada produto deve ter uma categoria
     * RETORNA: Relacionamento belongsTo com a tabela categorias
     */
    public function categoria()
    {
        /* Retorna a categoria deste produto */
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}

