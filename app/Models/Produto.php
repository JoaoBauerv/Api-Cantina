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

}
