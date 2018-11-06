<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_name',
        'email',
        'status',
        'role_id',
        'name',
    ];

    public function candidate()
    {
        return $this->hasOne('App\Models\Candidate', 'user_id', 'id');
    }

    public function cvs()
    {
        return $this->hasMany('App\Models\Cv');
    }

    public function jobs()
    {
        return $this->hasMany('App\Models\Job');
    }

    public function application()
    {
        return $this->belongsTo('App\Models\Application');
    }
}
