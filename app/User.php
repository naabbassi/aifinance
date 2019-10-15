<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'family','birthday','email', 'password','type'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function deposit(){
        return $this->hasMany('App\deposit','uid');
    }
    public function network(){
        return $this->hasMany('App\User','owner','email')->select(array('id','name'));
    }
    public function wallet(){
        return $this->hasMany('App\wallet','uid');
    }
    public function revenue(){
        return  $this->hasMany('App\revenue','uid');
    }
    public function withdraw(){
        return  $this->hasMany('App\withdraw','uid');
    }
    public function issues(){
        return $this->hasMany('App\issue','uid');
    }
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}
