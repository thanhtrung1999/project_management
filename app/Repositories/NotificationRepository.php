<?php

namespace App\Repositories;

use App\Models\Notification;
use Carbon\Carbon;

class NotificationRepository extends BaseRepository
{
    public function model()
    {
        return Notification::class;
    }

    public function getByAccount($accountId)
    {
        return $this->model
            ->where('notifiable_id', $accountId)
            ->where('notifiable_type', Account::class)
            ->whereNull('read_at')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function markRead($uuid)
    {
        return $this->model->where('id', $uuid)->update([
            'read_at' => Carbon::now()
        ]);
    }
}
