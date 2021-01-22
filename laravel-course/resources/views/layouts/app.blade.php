<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>Marketplace</title>

        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-2">
            <a class="navbar-brand" href="{{ route('home') }}">Marketplace</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
              <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                @auth
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item @if ( request()->is('admin/orders*') ) active @endif">
                            <a class="nav-link" href="{{ route('admin.order.index') }}">Meus Pedidos</a>
                        </li>

                        <li class="nav-item @if(request()->is('admin/stores*')) active @endif"> {{-- Se a rota for 'admin/stores', colocar o atributo 'active' --}}
                            <a class="nav-link" href="{{ route('admin.stores.index') }}">Loja</a>
                        </li>

                        <li class="nav-item @if(request()->is('admin/products*')) active @endif">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">Produtos</a>
                        </li>

                        <li class="nav-item @if(request()->is('admin/categories*')) active @endif">
                            <a class="nav-link" href="{{ route('admin.categories.index') }}">Categorias</a>
                        </li>
                    </ul>
                    <div class="my-2 my-lg-0">
                        <ul class="navbar-nav mr-auto">
                            <li class="nav-item mr-5">
                                <a href="{{ route('admin.notification.index') }}" class="nav-link @if (request()->is('admin/notifications*')) active @endif">
                                    <span class="badge badge-danger">
                                        {{auth()->user()->unreadNotifications->count()}}
                                    </span>

                                    Notificação
                                </a>
                            </li>

                            <li class="nav-item active">
                                <a class="nav-link" href="#" onclick="event.preventDefault(); document.querySelector('form.logout').submit();">Sair</a>

                                <form class="logout" action="{{ route('logout') }}" method="POST">
                                    @csrf
                                </form>
                            </li>
                            <li class="nav-item">
                                <span class="nav-link">{{ auth()->user()->name }}</span>
                            </li>
                        </ul>
                    </div>
                @endauth
            </div>
        </nav>

        <div class="container">
            @include('flash::message')
            @yield('content')
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="js/app.js"></script>
    </body>
</html>
