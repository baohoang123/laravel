<?php

namespace App\Modules\Backend\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
//use App\Http\Controllers\Controller;

use Illuminate\Routing\Controller;

class AuthController extends Controller
{
    //
	use DispatchesJobs, ValidatesRequests;
	 
	 
	    private $guard;
	    protected $redirectTo = 'admin/dashboard';
	 
	    const BASE_URL = '/admin';
	 
	    public function __construct(){
	  	
	        $this->guard = Auth::guard('admin');
	        
	    }
	 
	    public function getIndex()
	    {
          return view('Backend::index');
	    }

	    public function getLogin(Request $request)
	    {
	        if ($this->guard->check())
	        {
	        	return redirect(self::BASE_URL . '/dashboard');
	        }
	        return view(
	            'Backend::login',
	            []
	        );

	    }

        public function postLogin(Request $request){
             
	        $credentials = [
	            'email' => $request->input('email'),
	            'password' => $request->input('password'),
	            'active' => 1
	        ];
	        
	        $remember_me = false;
	        if($request->has('remember_me') && $request->input('remember_me') == 1)
	            $remember_me = true;
	       
	        print_r(Auth::user());
	        if(Auth::guard('admin')->attempt($credentials, $remember_me)){
	            $admin = $this->guard->user();
	            if($admin->active == 0){
	                $this->guard->logout();
	                return redirect(self::BASE_URL . '/login')->with('message-error', 'Account is not actived.');
	            }
	             //dd(session());
	            return redirect(self::BASE_URL . '/dashboard');
	            //return "chay vao dashboard";
	        }
	 
	 
	        return redirect()->route('login')->with('message-error', 'The credentials is not found.');
	 
    	}
        
        public function getDashboard(Request $request) {
              
              return view ('Backend::index');
        }

	    public function getLogout(){

	        $this->guard->logout();
            //dd(session())
            //\Log::debug(session());
            //\Log::info('Ghi log thông tin.');
	        session()->flush();
	        return redirect()->guest(self::BASE_URL . '/login');
    	}

}
