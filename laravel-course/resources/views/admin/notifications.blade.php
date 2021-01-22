@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <a href="{{ route('admin.notification.readNotification.all') }}" class="btn btn-lg btn-success">Marcar todas como lidas</a>
            <hr>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Notificação</th>
                <th>Criado</th>
                <th>Ação</th>
            </tr>
        </thead>

        <tbody>
            @forelse ($unreadNotifications as $notification)
                <tr>
                    <td>{{ $notification->data['message'] }}</td>
                    <td>{{ $notification->created_at->format('d/m/Y H:i:s') }}. {{ $notification->created_at->locale('pt')->diffForHumans() }}</td>
                    <td>
                        <div class="btn-group">
                            <a href="{{ route('admin.notification.readNotification.specific', ['notificationId' => $notification->id]) }}" class="btn btn-sm btn-primary">Marcar como lida</a>
                        </div>
                    </td>
                </tr>
            @empty
                <div class="alert alert-warning">Nenhuma notificação</div>
            @endforelse
        </tbody>
    </table>
@endsection
