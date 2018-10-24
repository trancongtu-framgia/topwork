<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'user_id',
        'dob',
        'address',
        'phone',
        'avatar_url',
        'description',
        'facebook',
        'youtube',
        'twister',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
