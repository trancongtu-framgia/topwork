<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\NotificationRepository;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationRepository;

    public function __construct(NotificationRepository $notificationRepository)
    {
        $this->notificationRepository = $notificationRepository;
    }

    public function changeStatus(Request $request)
    {
        $updatedNotification = $this->notificationRepository->updateNotificationStatus($request->id);

        return response()->json(['change status successfully'], 200);
    }
}
