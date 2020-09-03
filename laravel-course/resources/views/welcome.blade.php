@extends('layouts.front')

@section('content')
    <div class="row">
        @foreach ( $products as $key => $product )
            <div class="col-lg-4 mb-2">
                <div class="card" style="width: 18rem;">
                    {{-- Verifica se o produto tem uma ou mais imagens --}}
                    @if ( $product->images->count() )
                        <img class="card-img-top" src="{{ asset('storage/' . $product->images->first()->image) }}" alt="image-photo.png">
                    @else
                        <img class="card-img-top" src="{{ asset('assets/images/no-photo.jpg') }}" alt="no-photo.jpg">
                    @endif

                    <div class="card-body">
                        <h2 class="card-title">{{ $product->name }}</h2>
                        <p class="card-text">{{ $product->description }}</p>
                        <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success">Ver Produto</a>
                    </div>
                </div>
            </div>

            {{-- Quando tiver na terceira coluna, fechar a 'div' da classe 'row' e abrir uma nova da mesma --}}
            @if ( ($key + 1) % 3 == 0 )
                </div> <div class="row">
            @endif
        @endforeach
@endsection
