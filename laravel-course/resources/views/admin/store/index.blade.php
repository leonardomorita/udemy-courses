@extends('layouts.app')

@section('content')
    @if (!$store)
        <a href="{{ route('admin.stores.create') }}" class="btn btn-lg btn-success">Adicionar loja</a>
    @else
        <table class="table table-striped" style="text-align: center">
            <thead>
                <tr>
                    <th>$</th>
                    <th>Loja</th>
                    <th>Quantidade de Produtos</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td>{{ $store->id }}</td>
                    <td>{{ $store->name }}</td>
                    <td>{{ $store->products->count() }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.stores.edit', ['store' => $store->id]) }}" class="btn btn-sm btn-primary">EDITAR</a>

                            <form action="{{ route('admin.stores.destroy', ['store' => $store->id]) }}" method="POST">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger">EXCLUIR</button>
                            </form>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    @endif

    {{-- Para usar este método, a variável tem que ser atribuída configurada com paginate() --}}
    {{-- Este método apresenta na tela os links para a navegação entre páginas da listagem --}}
    {{-- {{ $stores->links() }} --}}
@endsection
