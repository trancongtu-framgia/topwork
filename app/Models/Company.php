<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'address',
        'user_id',
        'phone',
        'range',
        'country',
        'working_day',
        'description',
        'logo_url',
    ];

    public function companyUser()
    {
        return $this->belongsTo('App\User','user_id', 'id');
    }
}
