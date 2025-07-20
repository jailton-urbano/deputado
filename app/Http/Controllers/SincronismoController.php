<?php

namespace App\Http\Controllers;

use App\Models\Deputado;
use App\Models\GastoDeputado;

class SincronismoController extends Controller
{
    public function index()
    {
        $total = Deputado::count();
        $processados = Deputado::whereHas('gastos')->count();
        $naoProcessados = $total - $processados;

        $ultimo = GastoDeputado::latest('updated_at')->first();

        return view('sincronismo.index', compact('total', 'processados', 'naoProcessados', 'ultimo'));
    }
}
