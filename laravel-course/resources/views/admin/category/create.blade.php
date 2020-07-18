@extends('layouts.app')

@section('content')
    <h1>Criar categoria</h1>

    <form action="{{ route('admin.categories.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="name">Nome da Categoria</label>
            <input type="text" id="name" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descrição da Categoria</label>
            <input type="text" id="description" class="form-control @error('description') is-invalid  @enderror" name="description" value="{{ old('description') }}">

            @error('description')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug da Categoria</label>
            <input type="text" id="slug" class="form-control" name="slug">
        </div>

        <button type="submit" class="btn btn-success btn-md">Criar Categoria</button>
    </form>
@endsection
