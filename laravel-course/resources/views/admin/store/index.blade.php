@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.stores.create') }}" class="btn btn-lg btn-success">Adicionar loja</a>

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
                    <td>
                        <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-primary">EDITAR</a>
                        <a href="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" class="btn btn-sm btn-danger">EXCLUIR</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Para usar este método, a variável tem que ser atribuída configurada com paginate() --}}
    {{-- Este método apresenta na tela os links para a navegação entre páginas da listagem --}}
    {{ $stores->links() }}
@endsection
