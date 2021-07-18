<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'id',
        'type',
        'notifiable_type',
        'notifiable_id',
        'data',
        'read_at'
    ];

    public $incrementing = false;

    public function getMessageAttribute()
    {
        $data = json_decode($this->data);
        return $data->message;
    }

    public function getLinkAttribute()
    {
        $data = json_decode($this->data);
        return $data->link;
    }
}
