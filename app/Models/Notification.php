<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notifications';

    protected $fillable = [
        'content',
        'sender',
        'receiver',
        'key',
        'type',
        'status',
    ];
}
