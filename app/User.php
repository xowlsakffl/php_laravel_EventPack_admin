<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $primaryKey = 'udx';
    protected $fillable = [
        'uid', 'password', 'name', 'email', 'email_auth', 'cell', 'cell_auth', 'tel', 'country', 'join_from', 'super', 'state'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        //'email_verified_at' => 'datetime',
    ];

    //유저는 여러개의 로그를 갖는다
    public function userActionLogs()
    {
        return $this->hasMany('App\UserActionLog', 'udx');
    }

    public function works()
    {
        return $this->hasMany('App\Work', 'udx');
    }
}
