@extends('layouts.front')

@section('stylesheets')
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endsection

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
                        <label for="card_name">Nome no cartão</label>
                        <input type="text" name="card_name" id="card_name" class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 form-group">
                        <label for="card_number">Número do cartão <span class="brand"></span></label>
                        <input type="text" name="card_number" id="card_number" class="form-control">
                        <input type="hidden" name="card_brand">
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

                    <div class="col-lg-12 installments form-group"></div>
                </div>

                <button class="btn btn-success btn-lg process-checkout">Efetuar pagamento</button>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://stc.sandbox.pagseguro.uol.com.br/pagseguro/api/v2/checkout/pagseguro.directpayment.js"></script>
    <script src="{{asset('assets/js/jquery.ajax.js')}}"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
        const sessionId = '{{ session()->get('pagseguro_session_code') }}';

        PagSeguroDirectPayment.setSessionId(sessionId);
    </script>

    <script>
        let amountTransaction = '{{$total}}';
        console.log(amountTransaction);
        let cardNumber = document.querySelector('input[name=card_number]');
        let spanBrand = document.querySelector('span.brand');

        cardNumber.addEventListener('keyup', function() {
            if ( cardNumber.value.length >= 6 ) {
                PagSeguroDirectPayment.getBrand({
                    cardBin: cardNumber.value.substr(0, 6),
                    success: function(res) {
                        const brand = `https://stc.pagseguro.uol.com.br/public/img/payment-methods-flags/68x30/${res.brand.name}.png`;
                        spanBrand.innerHTML = `<img src=${brand} alt=${res.brand.name}>`;

                        document.querySelector('input[name=card_brand]').value = res.brand.name;

                        getInstallments(amountTransaction, res.brand.name);
                    },
                    error: function(err) {
                        console.log(err);
                    },
                    complete: function(res) {
                        // console.log('Complete: ' + res);
                    }
                });
            }
        });

        let submitButton = document.querySelector('button.process-checkout');
        submitButton.addEventListener('click', function(event) {
            event.preventDefault();

            PagSeguroDirectPayment.createCardToken({
                cardNumber: document.querySelector('input[name=card_number]').value,
                brand: document.querySelector('input[name=card_brand]').value,
                cvv: document.querySelector('input[name=card_cvv]').value,
                expirationMonth: document.querySelector('input[name=card_month]').value,
                expirationYear: document.querySelector('input[name=card_year]').value,
                success: function(res) {
                    console.log(res.card.token);
                    proccessPayment(res.card.token);
                }
            });
        });

        function proccessPayment(token) {
            let data = {
                card_token: token,
                hash: PagSeguroDirectPayment.getSenderHash(), // Hash que identifica o usuário nesta sessão
                installment: document.querySelector('select.select-installments').value,
                card_name: document.querySelector('input[name=card_name]').value,
                _token: '{{csrf_token()}}'
            }

            $.ajax({
                type: 'POST',
                url: '{{ route("checkout.proccess") }}',
                data: data,
                dataType: 'json', // Aceita somente o json
                success: function(res) {
                    toastr.success(res.data.message, 'Sucesso.');
                    window.location.href = '{{ route('checkout.thanks') }}?order=' + res.data.order;
                }
            });
        }

        function getInstallments(amount, brand) {
            PagSeguroDirectPayment.getInstallments({
                amount: amount,
                brand: brand,
                maxInstallmentsNoInterest: 0,
                success: function(res) {
                    let selectInstallments = drawSelectInstallments(res.installments[brand]);
                    document.querySelector('div.installments').innerHTML = selectInstallments;
                    console.log(res);
                },
                error: function(err) {

                },
                complete: function(res) {

                }
            });
        }

        function drawSelectInstallments(installments) {
            let select = '<label>Opções de Parcelamento:</label>';

            select += '<select class="form-control select-installments">';

            for(let l of installments) {
                select += `<option value="${l.quantity}|${l.installmentAmount}">${l.quantity}x de ${l.installmentAmount} - Total fica ${l.totalAmount}</option>`;
            }


            select += '</select>';

            return select;
        }
    </script>
@endsection
