@extends('layouts.app')

@section('content')
    <h1>Criar produto</h1>

    <form action="{{ route('admin.products.store') }}" method="post">
        @csrf

        <div class="form-group">
            <label for="product">Nome do produto</label>
            <input type="text" id="product" class="form-control" name="name" autofocus>
        </div>

        <div class="form-group">
            <label for="description">Descrição do produto</label>
            <input type="text" id="description" class="form-control" name="description">
        </div>

        <div class="form-group">
            <label for="body">Características do produto</label>
            <textarea id="body" class="form-control" name="body" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <label for="price">Preço do produto</label>
            <input type="number" id="price" class="form-control" name="price">
        </div>

        <div class="form-group">
            <label for="slug">Slug do produto</label>
            <input type="text" id="slug" class="form-control" name="slug">
        </div>

        <div class="form-group">
            <label>Lojas</label>
            <select class="form-control" name="store">
                @foreach($stores as $store)
                    <option value="{{ $store->id }}">{{ $store->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <button type="submit" class="btn btn-success btn-md">Criar produto</button>
        </div>
    </form>
@endsection
