@extends('layouts.front');

@section('content')
    <h2 class="alert alert-success">Obrigado!</h2>
    <h3 class="alert alert-success">Seu pedido foi processado. Código do seu pedido: {{ request()->get('order') }}</h3>
@endsection
