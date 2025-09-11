<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lote extends Model
{
    use HasFactory;

    protected $table = 'tb_lote';
    protected $primaryKey = 'id_lote';
    public $timestamps = false;

    protected $fillable = [
        'dt_entrada',
        'id_usuario',
    ];

    public function produtosLote()
    {
        return $this->hasMany(ProdutoLote::class, 'id_lote', 'id_lote');
    }
}