<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cv extends Model
{
    protected $table = 'cvs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'date',
        'status',
        'user_id',
        'url',
    ];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
