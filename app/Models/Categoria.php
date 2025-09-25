<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produtos;

/**
 * Modelo Categoria
 * 
 * Representa uma categoria de produtos no sistema.
 * Organiza os produtos em grupos para melhor navegação.
 * 
 * @property int $id
 * @property string $name Nome da categoria
 * @property string $descricao Descrição da categoria
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 */
class Categoria extends Model
{
    use HasFactory;

    /* 
     * CAMPOS FILLABLE - Campos que podem ser preenchidos em massa
     * Define quais campos podem ser preenchidos usando create() ou fill()
     */
    protected $fillable = [
        "name",        /* Nome da categoria */
        "descricao",   /* Descrição da categoria */
    ];

    /* 
     * RELACIONAMENTO: Categoria possui muitos produtos
     * Uma categoria pode ter vários produtos
     * RETORNA: Relacionamento hasMany com a tabela produtos
     */
    public function produtos()
    {
        /* Retorna todos os produtos desta categoria */
        /* Parâmetros: Modelo, chave estrangeira, chave local */
        return $this->hasMany(Produtos::class, 'id_categoria', 'id');
    }
}
