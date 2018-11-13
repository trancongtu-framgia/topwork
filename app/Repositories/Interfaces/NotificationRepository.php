<?php
/**
 * Created by PhpStorm.
 * User: tran.minh.hoang
 * Date: 12/11/2018
 * Time: 09:02
 */

namespace App\Repositories\Interfaces;


interface NotificationRepository extends BaseRepository
{
    public function updateNotificationStatus($notificationId);
}
