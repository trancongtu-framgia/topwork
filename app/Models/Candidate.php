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
        'user_id',
        'dob',
        'address',
        'phone',
        'avatar_url',
        'description',
        'facebook',
        'youtube',
        'twitter',
        'experience',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
