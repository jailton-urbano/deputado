<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deputado;
use App\Jobs\ProcessarGastosDeputado;
use App\Jobs\ImportarDeputadoJob;
use App\Models\GastoDeputado;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
class DeputadoController extends Controller
{
    public function  index(Request $request)
    {
        $query = Deputado::query();

        if ($request->filled('nome')) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        }

        if ($request->filled('partido')) {
            $query->where('partido', 'like', '%' . $request->partido . '%');
        }

        if ($request->filled('uf')) {
            $query->where('uf', $request->uf);
        }

        $deputados = $query->paginate(10)->appends($request->query());

        return view('deputados.index', compact('deputados'));
    }
    public function sincronizar()
    {
        ImportarDeputadoJob::dispatch();

        return redirect()->route('deputados.index')->with('success', 'Sincronização iniciada!');

    }

    public function limpar()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0');

        GastoDeputado::truncate();
        Deputado::truncate(); // Isso também apagará os gastos, se o relacionamento tiver "on delete cascade"
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        return redirect()->route('deputados.index')->with('success', 'Deputados removidos com sucesso.');
    }
}
