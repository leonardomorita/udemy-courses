@extends('layouts.app')

@section('content')
    <h1>Atualizar produto</h1>

    <form action="{{ route('admin.products.update', ['product' => $product->id]) }}" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="form-group">
            <label for="product">Nome do produto</label>
            <input type="text" id="product" class="form-control" name="name" value="{{ $product->name }}" autofocus>
        </div>

        <div class="form-group">
            <label for="description">Descrição do produto</label>
            <input type="text" id="description" class="form-control" name="description" value="{{ $product->description }}">
        </div>

        <div class="form-group">
            <label for="body">Características do produto</label>
            <textarea id="body" class="form-control" name="body" cols="30" rows="10">{{ $product->body }}</textarea>
        </div>

        <div class="form-group">
            <label for="price">Preço do produto</label>
            <input type="number" id="price" class="form-control" name="price" value="{{ $product->price }}">
        </div>

        <div class="form-group">
            <label for="slug">Slug do produto</label>
            <input type="text" id="slug" class="form-control" name="slug" value="{{ $product->slug }}">
        </div>

        <div>
            <button type="submit" class="btn btn-success btn-md">Atualizar produto</button>
        </div>
    </form>
@endsection
