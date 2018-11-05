<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'user_name',
        'email',
        'status',
        'role_id',
        'name',
        'password',
        'remember_token',
        'token',
    ];

    protected $hidden = [
        'password',
        'remember_token',
        'token',
    ];

    public function userRole()
    {
        return $this->belongsTo('App\Models\Role', 'role_id', 'id');
    }

    public function userCompany()
    {
        return $this->hasOne('App\Models\Company', 'user_id', 'id');
    }

}
