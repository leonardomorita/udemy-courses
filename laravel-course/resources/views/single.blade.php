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
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <hr>

            {{ $product->body }}
        </div>
    </div>
@endsection
