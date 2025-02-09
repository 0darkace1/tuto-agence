<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class NotificationController extends Controller
{
    public function index()
    {
        return view("admin.notifications.index", [
            'notifications' => auth()->user()->notifications,
        ]);
    }

    public function show(string $notificationId)
    {
        $notification = auth()->user()->notifications->where('id', $notificationId)->first();

        $notification->markAsRead();

        return view('admin.notifications.show', [
            'notification' => $notification,
        ]);
    }

    public function destroy(string $notificationId)
    {
        $notification = auth()->user()->notifications->where('id', $notificationId)->first();

        $notification->delete();

        return to_route("admin.notifications.index")->with("success", "La notification a bien été supprimé");
    }
}
