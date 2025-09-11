<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Medida extends Model
{
    protected $table = 'tb_medida';
    protected $primaryKey = 'id_medida';
    public $timestamps = false;
    
    protected $fillable = [
        'nm_medida',
    ];
}
