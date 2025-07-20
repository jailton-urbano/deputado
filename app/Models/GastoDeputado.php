<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoDeputado extends Model
{
    protected $fillable = [
        'deputado_id',
        'tipo_despesa',
        'data',
        'valor'
    ];
    use HasFactory;
}
