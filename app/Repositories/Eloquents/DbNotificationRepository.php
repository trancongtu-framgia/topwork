<?php

namespace App\Repositories\Eloquents;

use App\Models\Notification;
use App\Repositories\Interfaces\JobRepository;
use App\Repositories\Interfaces\NotificationRepository;
use App\Repositories\Interfaces\UserRepository;

class DbNotificationRepository extends DbBaseRepository implements NotificationRepository
{
    protected $model;
    protected $userRepository;
    protected $jobRepository;

    /**
     * @param Notification $model
     *
     */
    function __construct(
        Notification $model,
        UserRepository $userRepository,
        JobRepository $jobRepository
    ) {
        $this->model = $model;
        $this->userRepository = $userRepository;
        $this->jobRepository = $jobRepository;
    }

    public function getAll($per)
    {
        return $this->basePaginateList($per);
    }

    public function create($param)
    {
        return $this->baseCreate($param);
    }

    public function get($key, $value)
    {
        return $this->baseFindBy($key, $value);
    }

    public function update($data, $key, $value)
    {
        return $this->baseUpdate($data, $key, $value);
    }

    public function delete($key, $value)
    {
        return $this->baseDestroy($key, $value);
    }

    public function getLatestNotification($token)
    {
        return $this->model::orderBy('created_at', 'desc')->where('receiver', $token)->take(config('app.notification_number'))->get();
    }

    public function updateNotificationStatus($notificationId)
    {
        $notification = $this->model::findOrFail($notificationId);
        if ($notification->status == config('app.notification_unread_status')) {
            $notification->status = config('app.notification_read_status');
        }
        $notification->save();
    }

    public function getNotificationDetail($validatedData, $candidateToken, $jobId, $createdAt)
    {
        $notificationData = [
            'title' => __('New Application'),
            'content' => $validatedData['candidate_name'] . __(' just have applied ') . $validatedData['job_title'],
            'job_id' => $validatedData['job_id'],
            'sender_token' => $candidateToken,
            'receiver_token' => $this->userRepository->getSpecifiedColumn(
                'id', $this->jobRepository->getSpecifiedColumn('id', $jobId, ['user_id'])->user_id, ['token'])->token,
            'created_at' => date(config('app.notification_date_format'), strtotime($createdAt)),
        ];

        return $notificationData;
    }

    public function createNotification($notificationData)
    {
        $recentlyAddedNotification = $this->create([
            'content' => $notificationData['content'],
            'sender' => $notificationData['sender_token'],
            'receiver' => $notificationData['receiver_token'],
            'key' => $notificationData['job_id'],
            'type' => config('app.notification_type.job'),
            'status' => config('app.notification_unread_status'),
        ]);

        return $recentlyAddedNotification;
    }
}
