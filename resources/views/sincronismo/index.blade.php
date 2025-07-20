@extends('layout')

@section('title', 'Acompanhamento de Sincronismo')

@section('content')
<h2 class="mb-4">Painel de Sincronismo</h2>

<div class="row mb-4">
    <div class="col-md-3">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Total de Deputados</h5>
                <p class="card-text display-6">{{ $total }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Processados</h5>
                <p class="card-text display-6">{{ $processados }}</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Pendentes</h5>
                <p class="card-text display-6">{{ $naoProcessados }}</p>
            </div>
        </div>
    </div>
    @if($ultimo)
    <div class="col-md-3">
        <div class="card bg-light">
            <div class="card-body">
                <h5 class="card-title">Último Atualizado</h5>
                <p class="card-text">
                    {{ $ultimo->tipo_despesa }}<br>
                    {{ $ultimo->updated_at->format('d/m/Y H:i:s') }}
                </p>
            </div>
        </div>
    </div>
    @endif
</div>

<a href="{{ route('deputados.index') }}" class="btn btn-secondary">← Voltar</a>
@endsection
