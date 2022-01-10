<?php

namespace App;

use Illuminate\Notifications\Notifiable;
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
        'users_email', 'users_password', 'users_name', 'users_address','users_phone','users_phone','users_avatar','active','token',
    ];

    protected $primaryKey = 'users_id';
    protected $table = 'users';
    protected $guard = 'user';
    protected $rememberTokenName = false;
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    // protected $hidden = [
    //     'password', 'remember_token',
    // ];

    public function getAuthPassword(){
        return $this->users_password;
    }
}
