@extends('layout')

@section('content')
    <h2>Lista de Deputados</h2>
    <table>
        <thead>
            <tr>
                <th>Nome</th>
                <th>Partido</th>
                <th>UF</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
        @foreach($deputados as $dep)
            <tr>
                <td>{{ $dep->nome }}</td>
                <td>{{ $dep->partido }}</td>
                <td>{{ $dep->uf }}</td>
                <td><a href="{{ route('despesas.index', $dep->id) }}">Ver Despesas</a></td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $deputados->links() }}
@endsection
