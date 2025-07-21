@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">🧾 Despesas do Deputado</h2>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('despesas.index', $deputado->id) }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="tipo" value="{{ request('tipo') }}" class="form-control" placeholder="Tipo de Despesa">
        </div>
        <div class="col-md-2">
            <input type="date" name="data_inicio" value="{{ request('data_inicio') }}" class="form-control" placeholder="De">
        </div>
        <div class="col-md-2">
            <input type="date" name="data_fim" value="{{ request('data_fim') }}" class="form-control" placeholder="Até">
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="valor_min" value="{{ request('valor_min') }}" class="form-control" placeholder="Valor Mínimo">
        </div>
        <div class="col-md-2">
            <input type="number" step="0.01" name="valor_max" value="{{ request('valor_max') }}" class="form-control" placeholder="Valor Máximo">
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">🔍 Filtrar</button>
        </div>
    </form>

    {{-- Totalizador --}}
    <div class="mb-3">
        <strong>Total de Despesas:</strong>
        R$ {{ number_format($totalDespesas, 2, ',', '.') }}
    </div>

    {{-- Tabela --}}
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Tipo de Despesa</th>
                <th>Data</th>
                <th class="text-end">Valor</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($despesas as $despesa)
                <tr>
                    <td>{{ $despesa->tipo_despesa }}</td>
                    <td>{{ \Carbon\Carbon::parse($despesa->data)->format('d/m/Y') }}</td>
                    <td class="text-end">R$ {{ number_format($despesa->valor, 2, ',', '.') }}</td>
                </tr>
            @empty
                <tr><td colspan="3">Nenhuma despesa encontrada.</td></tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginação com filtros --}}
    <div class="d-flex justify-content-center">
        {!! $despesas->appends(request()->query())->links() !!}
    </div>
</div>
@endsection
