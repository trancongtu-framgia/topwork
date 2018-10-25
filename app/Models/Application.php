<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $table = 'applications';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'date',
        'user_id',
        'job_id',
        'cv_url',
        'status',
        'self_introduction',
    ];

    public  function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function job()
    {
        return $this->belongsTo('App\Models\Job');
    }
}
