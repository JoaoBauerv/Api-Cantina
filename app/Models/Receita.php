<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receita extends Model
{
    use HasFactory;

    protected $table = 'tb_receita';
    protected $primaryKey = 'id_receita';
    public $timestamps = false;

    protected $fillable = [
        'nm_receita',
        'id_medida',
    ];

    public function produtosReceita()
    {
        return $this->hasMany(ProdutoReceita::class, 'id_receita', 'id_receita');
    }

    public function CardapioReceita()
    {
        return $this->belongsTo(CardapioReceita::class, 'id_cardapio', 'id_cardapio');
    }
}
