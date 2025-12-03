<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'tb_produto';
    protected $primaryKey = 'id_produto';
    public $timestamps = false;
    
    protected $fillable = [
        'nm_produto',
        'id_medida',
        'qt_estoque',
        
    ];
    public function produtosLote()
    {
        return $this->hasMany(ProdutoLote::class, 'id_produto', 'id_produto');
    }
    public function produtosReceita()
    {
        return $this->hasMany(ProdutoReceita::class, 'id_produto', 'id_produto');
    }
}
