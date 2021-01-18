<h1>Olá {{ $user->name }}, tudo bem? Espero que sim.</h1>
<h2>Obrigado por sua inscrição do curso na nossa plataforma de curso Online.</h2>

<p>Aproveite o conteúdo. Qualquer dúvida, pode entrar em contato conosco.</p>
<p>Seu e-mail cadastrado foi: <strong>{{ $user->email }}</strong>.</p>

<hr>

<p>E-mail enviado em {{ date('d/m/Y H:i:s') }}.</p>
