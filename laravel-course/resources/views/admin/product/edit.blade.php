@extends('layouts.app')

@section('content')
    <h1>Atualizar produto</h1>

    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label for="product">Nome do produto</label>
            <input type="text" id="product" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" autofocus>

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="description">Descrição do produto</label>
            <input type="text" id="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ $product->description }}">

            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="body">Características do produto</label>
            <textarea id="body" class="form-control @error('body') is-invalid @enderror" name="body" cols="30" rows="10">{{ $product->body }}</textarea>

            @error('body')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="price">Preço do produto</label>
            <input type="text" id="price" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}">

            @error('price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="category">Categorias</label>
            <select name="categories[]" id="category" class="form-control @error('categories') is-invalid @enderror" multiple>

                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @if($product->categories->contains($category)) selected @endif>{{ $category->name }}</option>
                @endforeach

            </select>

            @error('categories')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="photos">Fotos do produto</label>
            <input type="file" id="photos" name="photos[]" class="form-control @error('photos.*') is-invalid @enderror" multiple>

            @error('photos.*')
                {{ $message }}
            @enderror
        </div>

        <div class="form-group">
            <label for="slug">Slug do produto</label>
            <input type="text" id="slug" class="form-control" name="slug" value="{{ $product->slug }}">
        </div>

        <div>
            <button type="submit" class="btn btn-success btn-md">Atualizar produto</button>
        </div>
    </form>

    <div class="row">
        @foreach ($product->images as $image)
            <div class="col-4 text-center">
                <img src="{{ asset('storage/' . $image->image) }}" alt="" class="img-fluid">

                <form action="{{ route('admin.photo.remove') }}" method="POST">
                    @csrf
                    <input type="hidden" name="photoName" value="{{ $image->image }}">
                    <button type="submit" class="btn btn-lg btn-danger">REMOVER</button>
                </form>
            </div>
        @endforeach
    </div>
@endsection
