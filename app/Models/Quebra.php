<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quebra extends Model
{
    use HasFactory;

    protected $table = 'tb_quebra_estoque';
    protected $primaryKey = 'id_quebra';
    public $timestamps = false;

    protected $fillable = [
        'qt_quebra',
        'id_usuario',
        'id_produto',
    ];

}
