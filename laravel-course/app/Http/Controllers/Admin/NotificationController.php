<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function notifications()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;

        return view('admin.notifications', compact('unreadNotifications'));
    }

    public function readAll()
    {
        $unreadNotifications = auth()->user()->unreadNotifications;
        $unreadNotifications->each(function($notification) {
            $notification->markAsRead();
        });

        flash('Todas notificações foram marcadas como lidas com sucesso')->success();
        return redirect()->route('admin.notification.index');
    }

    public function readSpecificNotification($notificationId)
    {
        auth()->user()->notifications()->find($notificationId)->markAsRead();

        flash('A notificação foi marcada como lida com sucesso')->success();
        return redirect()->route('admin.notification.index');
    }
}
