<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardapioReceita extends Model
{
    use HasFactory;

    protected $table = 'tb_cardapio_receita';
    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;

    protected $fillable = [
        'id_receita',
        'id_cardapio',
        'qt_produzida',
    ];

    public function cardapio()
    {
        return $this->belongsTo(Cardapio::class, 'id_cardapio', 'id_cardapio');
    }

    public function receita()
    {
        return $this->hasMany(Receita::class, 'id_receita', 'id_receita');
    }

}
