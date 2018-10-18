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
    ];
}
