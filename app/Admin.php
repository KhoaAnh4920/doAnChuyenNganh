<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'users_email', 'users_password', 'users_name', 'users_address','users_phone','users_phone','users_avatar','active','token',
    ];

    protected $primaryKey = 'users_id';
    protected $table = 'users';
    protected $guard = 'admin';
    protected $rememberTokenName = false;

    public function getAuthPassword(){
        return $this->users_password;
    }
}
