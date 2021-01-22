@extends('layouts.app')

@section('content')
    <a href="{{ route('admin.notification.readNotification.all') }}" class="btn btn-lg btn-success">Marcar todas como lidas</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Notificação</th>
                <th>Criado</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($unreadNotifications as $notification)
                <tr>
                    <td>{{ $notification->data['message'] }}</td>
                    <td>{{ $notification->created_at->format('d/m/Y H:i:s') }}. {{ $notification->created_at->locale('pt')->diffForHumans() }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="#" class="btn btn-sm btn-primary">Marcar como lida</a>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
