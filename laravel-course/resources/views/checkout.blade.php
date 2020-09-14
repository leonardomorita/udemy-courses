@extends('layouts.front')

@section('content')
    <div class="container">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Dados para pagamento</h2>
                    <hr>
                </div>
            </div>

            <form action="" method="POST">
                <div class="row">
                    <div class="col-lg-12 form-group">
                        <label for="card_number">Número do cartão</label>
                        <input type="text" name="card_number" id="card_number" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-4 form-group">
                        <label for="card_month">Mês de expiração</label>
                        <input type="number" name="card_month" id="card_month">
                    </div>

                    <div class="col-lg-4 form-group">
                        <label for="card_year">Ano de expiração</label>
                        <input type="number" name="card_year" id="card_year">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-5 form-group">
                        <label for="card_cvv">Código de segurança</label>
                        <input type="text" name="card_cvv" id="card_cvv">
                    </div>
                </div>

                <button class="btn btn-success btn-lg">Efetuar pagamento</button>
            </form>
        </div>
    </div>
@endsection
