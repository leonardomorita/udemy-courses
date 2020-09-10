@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Carrinho de Compras</h2>

            <hr>
        </div>

        <div class="col-12">
            @if ($cart)
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Produto</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>SubTotal</th>
                            <th>Ação</th>
                        </tr>
                    </thead>

                    <tbody>
                        @php
                            $total = 0;
                        @endphp

                        @foreach ($cart as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>R$ {{ number_format( $item['price'], 2, ',', '.' ) }}</td>
                                <td>{{ $item['amount'] }}</td>

                                @php
                                    $subtotal = $item['price'] * $item['amount'];
                                    $total += $subtotal;
                                @endphp
                                <td>R$ {{ number_format( $subtotal, 2, ',', '.' ) }}</td>

                                <td>
                                    <a href="{{ route('cart.remove', ['slug' => $item['slug']]) }}" class="btn btn-sm btn-danger">REMOVER</a>
                                </td>
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="3">Total:</td>
                            <td colspan="2">R$ {{ number_format( $total, 2, ',', '.' ) }}</td>
                        </tr>
                    </tbody>
                </table>

                <hr>

                <div class="col-lg-12">
                    <a href="{{ route('checkout.index') }}" class="btn btn-md btn-success float-right">Concluir Compra</a>
                    <a href="{{ route('cart.cancel') }}" class="btn btn-sm btn-danger float-left">Cancelar Compra</a>
                </div>
            @else
                <div class="alert alert-warning">O carrinho está vazio.</div>
            @endif
        </div>
    </div>
@endsection
