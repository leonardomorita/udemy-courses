@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.categories.create') }}" class="btn btn-lg btn-success">Adicionar Categoria</a>

    @if (count($categories) === 0)
        @php
            flash("Não existe nenhuma categoria")->warning();
        @endphp
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>$</th>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <div class="btn-group">
                                <a href="{{ route('admin.categories.edit', ['category' => $category->id]) }}" class="btn btn-primary btn-sm">EDITAR</a>

                                <form action="{{ route('admin.categories.destroy', ['category' => $category->id]) }}" method="POST">
                                    @csrf
                                    @method("DELETE")

                                    <button type="submit" class="btn btn-danger btn-sm">EXCLUIR</button>
                                </form>
                            </div>


                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    @endif
@endsection
