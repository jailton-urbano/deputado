<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deputado extends Model
{
    protected $fillable = ['id', 'nome', 'partido', 'uf'];

    use HasFactory;
    public function gastos()
    {
        return $this->hasMany(\App\Models\GastoDeputado::class);
    }
}
