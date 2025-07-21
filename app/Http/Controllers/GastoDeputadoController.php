<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GastoDeputado;
use App\Models\Deputado;

class GastoDeputadoController extends Controller
{
    public function index(Request $request, $id)
    {
        $deputado = Deputado::findOrFail($id); // busca o deputado

        $query = GastoDeputado::where('deputado_id', $id);

        if ($request->filled('tipo')) {
            $query->where('tipo_despesa', 'like', '%' . $request->tipo . '%');
        }

        if ($request->filled('data_inicio')) {
            $query->whereDate('data', '>=', $request->data_inicio);
        }

        if ($request->filled('data_fim')) {
            $query->whereDate('data', '<=', $request->data_fim);
        }

        if ($request->filled('valor_min')) {
            $query->where('valor', '>=', $request->valor_min);
        }

        if ($request->filled('valor_max')) {
            $query->where('valor', '<=', $request->valor_max);
        }

        $despesas = $query->orderBy('data', 'desc')->paginate(20);
        $totalDespesas = $query->sum('valor');

        return view('despesas.index', compact('despesas', 'totalDespesas', 'deputado'));
    }

}
