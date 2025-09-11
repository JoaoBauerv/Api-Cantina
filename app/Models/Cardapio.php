<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cardapio extends Model
{
    use HasFactory;

    protected $table = 'tb_cardapio';
    protected $primaryKey = 'id_cardapio';
    public $timestamps = false;

    protected $fillable = [
        'dt_cardapio',
    ];

    public function cardapioReceitas()
    {
        return $this->hasMany(CardapioReceita::class, 'id_cardapio', 'id_cardapio');
    }
}
