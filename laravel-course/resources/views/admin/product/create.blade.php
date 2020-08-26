@extends('layouts.app')

@section('content')
    <h1>Criar produto</h1>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="product">Nome do produto</label>
            <input type="text" name="name" id="product" class="form-control @error('name') is-invalid @enderror" autofocus>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descrição do produto</label>
            <input type="text" name="description" id="description" class="form-control @error('description') is-invalid @enderror">

            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="body">Características do produto</label>
            <textarea name="body" id="body" class="form-control @error('body') is-invalid @enderror" cols="30" rows="10"></textarea>

            @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Preço do produto</label>
            <input type="text" name="price" id="price" class="form-control @error('price') is-invalid @enderror">

            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Categorias</label>
            <select name="categories[]" id="category" class="form-control" multiple>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="photos">Fotos do produto</label>
            <input type="file" id="photos" name="photos[]" class="form-control @error('photos') is-invalid @enderror" multiple>

            @error('photos')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug do produto</label>
            <input type="text" id="slug" class="form-control" name="slug">
        </div>

        <div>
            <button type="submit" class="btn btn-success btn-md">Criar produto</button>
        </div>
    </form>
@endsection
