<?php

namespace App\Modules\Backend\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;


class Users extends Authenticatable
{
    //
    protected $table = 'users';
    public $timestamps = false;
    protected $guard = 'admin';
    
    
    protected $fillable = [
    	'firstname',
    	'surname',
    	'email',
    	'password',
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
