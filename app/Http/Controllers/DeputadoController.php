<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Deputado;
class DeputadoController extends Controller
{
    public function index()
    {
        $deputados = Deputado::orderBy('nome')->paginate(20);
        return view('deputados.index', compact('deputados'));
    }
}
