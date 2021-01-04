@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Pedidos Recebidos</h2>
            <hr>
        </div>

        <div class="col-12">
            <div class="accordion" id="accordionExample">
                @forelse( $orders as $key => $order )
                    <div class="card">
                        <div class="card-header" id="headingOne">
                            <h5 class="mb-0">
                                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse{{ $key }}" aria-expanded="true" aria-controls="collapse{{ $key }}">
                                    Pedido nº: {{ $order->reference }}
                                </button>
                            </h5>
                        </div>

                        <div id="collapse{{ $key }}" class="collapse @if ( $key === 0 ) show @endif" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                                <ul>
                                    @php
                                        $items = unserialize($order->items);
                                    @endphp

                                    @foreach ( filterItemsByStoreId($items, auth()->user()->store->id) as $item )
                                        <li><strong>Nome do Produto:</strong> {{ $item['name'] }} | <strong>Preço do Produto:</strong> R$ {{ number_format($item['price'], 2, ',', '.') }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="alert alert-warning">Nenhum pedido recebido</div>
                @endforelse
            </div>

            <div class="col-12">
                <hr>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
