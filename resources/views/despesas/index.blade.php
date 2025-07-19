@extends('layout')

@section('content')
    <h2>Despesas do Deputado</h2>
    <table>
        <thead>
            <tr>
                <th>Tipo de Despesa</th>
                <th>Data</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
        @foreach($despesas as $gasto)
            <tr>
                <td>{{ $gasto->tipo_despesa }}</td>
                <td>{{ \Carbon\Carbon::parse($gasto->data)->format('d/m/Y') }}</td>
                <td>R$ {{ number_format($gasto->valor, 2, ',', '.') }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $despesas->links() }}
@endsection
