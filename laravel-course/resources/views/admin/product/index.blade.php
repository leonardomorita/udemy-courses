@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.products.create') }}" class="btn btn-lg btn-success">Adicionar Produto</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>$</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->price }}</td>
                    <td>
                        <a href="{{ route('admin.products.edit', ['product' => $product->id]) }}" class="btn btn-sm btn-primary">EDITAR</a>
                        <a href="{{ route('admin.products.destroy', ['product' => $product->id]) }}" class="btn btn-sm btn-danger">EXCLUIR</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Para usar este método, a variável tem que ser atribuída configurada com paginate() --}}
    {{-- Este método apresenta na tela os links para a navegação entre páginas da listagem --}}
    {{ $products->links() }}
@endsection
