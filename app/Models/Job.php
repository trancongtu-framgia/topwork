<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    protected $table = 'jobs';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'title',
        'salary_min',
        'salary_max',
        'description',
        'job_type_id',
        'location_id',
        'experience',
        'out_date',
        'is_available',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function applications()
    {
        return $this->hasMany('App\Models\Application');
    }

    public function locationJobs()
    {
        return $this->belongsTo('\App\Models\Location', 'location_id', 'id');
    }

    public function userJob()
    {
        return $this->belongsTo('\App\User', 'user_id', 'id');
    }

    public function jobTypeJobs()
    {
        return $this->belongsTo('\App\Models\JobType', 'job_type_id', 'id');
    }
}
