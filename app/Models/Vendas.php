<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $fillable = [
        'pedido',
        'items',
        'valor',
        'id_user'
    ];

    public function produtos(){
    return $this->hasMany(Produtos::class, "items");
    }
    public function user(){
    return $this->belongsTo(User::class, "id_user");
    }

    }
