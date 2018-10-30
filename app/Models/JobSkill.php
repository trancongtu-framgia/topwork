<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobSkill extends Model
{
    protected $table = 'job_skills';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'job_id',
        'skill_id',
    ];

    public function skillJobs()
    {
        return $this->belongsTo('\App\Models\Skill', 'skill_id', 'id');
    }
}
