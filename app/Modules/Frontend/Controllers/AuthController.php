<?php

namespace App\Modules\Frontend\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    //
    use DispatchesJobs, ValidatesRequests;

    private $guard;
    
    const BASE_URL = '/';

    public function __construct()
    {
    	$this->guard = Auth::guard('employee');
    }


    public function getIndex()
    {
        return view('Frontend::index');
    }

    public function getLogin(Request $request)
    {
    	if($this->guard->check()){
         	return view('Frontend::index');
    	}
    	return view(
    		'Frontend::login',
    		[]
    	);
      
    	
    }

    public function postLogin(Request $request)
    {
     	$credentials = [
     		'email' => $request->input('email'),
     		'password' => $request->input('password')
     	];
      
     	$remember_me = false;
     	if($request->has('remember_me') && $Request->input('remember_me') == 1)
     		$remember_me = true;

        var_dump($remember_me);
     	if($this->guard->attempt($credentials, $remember_me)){
     		$employee = $this->guard->user();
     		if($employee->active == 0){
     			$this->guard->logout();
                dd($credentials);
     			return redirect(self::BASE_URL . 'login') ->with('message-error', 'Account is not actived.');
     		}
     		return redirect(self::BASE_URL);
     	}

     	return redirect()->guest('login')->with('message-error', 'The credentials is not found.');
    }

    public function getLogout(Request $request)
    {
      $this->guard->logout();
      session()->flush();
      return redirect()->guest(self::BASE_URL . 'login');
    }


}
