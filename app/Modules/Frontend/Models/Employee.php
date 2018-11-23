<?php

namespace App\Modules\Frontend\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class Employee extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    //
    use Authenticatable, CanResetPassword;
 
    protected $table = 'employees';
    public $timestamps = false;
    protected $guard = 'employee';
 
    protected $fillable = [
        'fullname',
        'email',
        'password',
        'mobile',
        'active'
    ];
 
    protected $guarded = [
        'id'
    ];
 
    protected $hidden = [
    	'password', 
    	'remember_token'
    ];

}
