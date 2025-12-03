<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoReceita extends Model
{
    use HasFactory;

    protected $table = 'tb_receita_produto';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'id_receita',
        'id_produto',
        'qt_usada',
    ];

    public function receita()
    {
        return $this->belongsTo(Receita::class, 'id_receita', 'id_receita');
    }
    public function produto()
    {
        return $this->belongsTo(Produto::class, 'id_produto', 'id_produto');
    }
}
