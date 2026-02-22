<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class UserLogin extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'user_logins';

    protected $fillable = [
        'name',
        'email',    
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}