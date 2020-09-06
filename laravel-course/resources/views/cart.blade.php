@extends('layouts.front')

@section('content')
    <div class="row">
        <div class="col-12">
            <h2>Carrinho de Compras</h2>

            <hr>
        </div>

        <div class="col-12">
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
                                <a href="#" class="btn btn-sm btn-danger">REMOVER</a>
                            </td>
                        </tr>
                    @endforeach

                    <tr>
                        <td colspan="3">Total:</td>
                        <td colspan="2">R$ {{ number_format( $total, 2, ',', '.' ) }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
