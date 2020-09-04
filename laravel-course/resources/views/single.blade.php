@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            @if ( $product->images->count() )
                <img class="img-fluid" src="{{ asset('storage/' . $product->images->first()->image) }}" alt="image-photo.png">
                <div class="row mt-2">
                    @foreach ($product->images as $image)
                        <div class="col-4">
                            <img class="img-fluid" src="{{ asset('storage/' . $image->image) }}" alt="image-photo.png">
                        </div>
                    @endforeach
                </div>
            @else
                <img class="card-img-top" src="{{ asset('assets/images/no-photo.jpg') }}" alt="no-photo.jpg">
            @endif
        </div>

        <div class="col-lg-8">
            <h2>{{ $product->name }}</h2>
            <p>{{ $product->description }}</p>
            <h3>R$ {{ number_format($product->price, '2', ',', '.') }}</h3>
            <span>Loja: {{ $product->store->name }}</span>

            <div class="product-add">
                <hr>

                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf

                    <input type="hidden" name="product[name]" value="{{ $product->name }}">
                    <input type="hidden" name="product[price]" value="{{ $product->price }}">
                    <input type="hidden" name="product[slug]" value="{{ $product->slug }}">

                    <div class="form-group">
                        <label for="quantity">Quantidade</label>
                        <input type="number" name="product[amount]" id="quantity" class="form-control col-lg-1" value="1">
                    </div>

                    <button class="btn btn-lg btn-danger">Comprar</button>
                </form>
            </div>
        </div>


    </div>

    <div class="row">
        <div class="col-12">
            <hr>

            {{ $product->body }}
        </div>
    </div>
@endsection
