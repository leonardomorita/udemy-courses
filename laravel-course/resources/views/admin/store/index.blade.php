{{-- Revisar --}}
@extends('layouts.app')

@section('content')
    <table class="table table-striped">
        <thead>
            <tr>
                <th>$</th>
                <th>Loja</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($stores as $store)
                <tr>
                    <td>{{ $store->id }}</td>
                    <td>{{ $store->name }}</td>
                    <td></td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Para usar este método, a variável tem que ser atribuída configurada com paginate() --}}
    {{-- Este método apresenta na tela os links para a navegação entre páginas da listagem --}}
    {{ $stores->links() }}
@endsection
