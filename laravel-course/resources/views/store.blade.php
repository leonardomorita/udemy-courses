@extends('layouts.front')

@section('stylesheets')

@endsection

@section('content')
    <div class="row">
        <div class="col-4">
            @if ( !$store->logo )
                <img class="img-fluid" src="https://via.placeholder.com/300x150.png?text=logo" alt="Loja sem logo">
            @else
                <img src="{{ asset('storage/' . $store->logo) }}" alt="{{ $store->name }}.png" class="img-fluid">
            @endif
        </div>

        <div class="col-8">
            <h1>{{ $store->name }}</h1>
            <p>{{ $store->description }}</p>
            <p>
                <h4>Contatos:</h4>
                <span>{{ $store->phone }}</span> | <span>{{ $store->mobile_phone }}</span>
            </p>
        </div>

        <div class="col-12">
            <h2>Produtos</h2>
            <hr>
        </div>

        @forelse ( $store->products as $key => $product )
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
                        <h3>R$ {{ number_format($product->price, '2', ',', '.') }}</h3>
                        <a href="{{ route('product.single', ['slug' => $product->slug]) }}" class="btn btn-success">Ver Produto</a>
                    </div>
                </div>
            </div>

            {{-- Quando tiver na terceira coluna, fechar a 'div' da classe 'row' e abrir uma nova da mesma --}}
            @if ( ($key + 1) % 3 == 0 )
                </div> <div class="row">
            @endif
        @empty
            <div class="col-12">
                <h3 class="alert alert-warning">Esta loja não tem nenhum produto.</h3>
            </div>
        @endforelse
    </div>
@endsection

@section('scripts')

@endsection
