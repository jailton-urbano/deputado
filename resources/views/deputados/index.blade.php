@extends('layout')

@section('title', 'Lista de Deputados')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">📋 Lista de Deputados</h2>

    {{-- Mensagens de sessão --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    {{-- Botões principais --}}
    <div class="mb-4 d-flex gap-2">
        <form method="POST" action="{{ route('deputados.sincronizar') }}">
            @csrf
            <button type="submit" class="btn btn-success">
                🔄 Sincronizar Dados
            </button>
        </form>

        <form method="POST" action="{{ route('deputados.limpar') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('Tem certeza que deseja apagar todos os deputados?')">
                🗑️ Limpar Deputados
            </button>
        </form>
    </div>

    {{-- Filtros --}}
    <form method="GET" action="{{ route('deputados.index') }}" class="mb-4 row g-2">
        <div class="col-md-4">
            <input type="text" name="nome" value="{{ request('nome') }}" class="form-control" placeholder="Filtrar por nome">
        </div>
        <div class="col-md-3">
            <input type="text" name="partido" value="{{ request('partido') }}" class="form-control" placeholder="Partido">
        </div>
        <div class="col-md-2">
            <input type="text" name="uf" value="{{ request('uf') }}" class="form-control" placeholder="UF">
        </div>
        <div class="col-md-3 d-flex gap-2">
            <button type="submit" class="btn btn-primary">🔍 Filtrar</button>
            <a href="{{ route('deputados.index') }}" class="btn btn-secondary">🧹 Limpar</a>
        </div>
    </form>

    {{-- Tabela --}}
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Partido</th>
                <th>UF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($deputados as $dep)
                <tr>
                    <td>{{ $dep->nome }}</td>
                    <td>{{ $dep->partido }}</td>
                    <td>{{ $dep->uf }}</td>
                    <td>
                        <a href="{{ route('despesas.index', $dep->id) }}" class="btn btn-sm btn-outline-primary">
                            Ver Despesas
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">Nenhum deputado encontrado.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Paginação --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $deputados->links() }}
    </div>
</div>
@endsection
