<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GastoDeputado;

class GastoDeputadoController extends Controller
{
    public function index($id)
    {
        $despesas = GastoDeputado::where('deputado_id', $id)->orderByDesc('data')->paginate(20);
        return view('despesas.index', compact('despesas'));
    }
}
