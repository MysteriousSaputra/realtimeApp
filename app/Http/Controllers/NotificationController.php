<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\NotificationResource;
use App\Models\Notification;

class NotificationController extends Controller
{
    public function index()
    {
        return [
            'readMotif' => NotificationResource::collection(auth()->user()->readNotifications),
            'unreadNotif' => NotificationResource::collection(auth()->user()->unReadNotifications)
        ];
    }

    public function readNotification(Request $request)
    {
        // auth()->user()->notification->where(['id', $request])->markAsRead();


        // $notif = Notification::find($request);
        // $notif->dlt = 0;
        // $notif->save();

        Notification::where('id', $request->id)
          ->update(['dlt' => 1]);


        return response("updated", 200);
    }
}
