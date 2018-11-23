<?php
Auth::routes();

Route::group([
	'module' => 'Backend', 
	'middleware' => ['web'], 
	'namespace' => 'App\Modules\Backend\Controllers'
	], function() {

    Route::prefix('admin')->group(function() {
       
        // Route::get('/', 'BackendController@index');
        Route::get('/', ['as' => '/', 'uses' => 'AuthController@getIndex']);	
        // admin@gmail.com, 123123
        // 'email' => 'lan@gmail.com', 'password' => '112233'	
        Route::post('/login', [ 'as' => 'login', 'uses' => 'AuthController@postLogin']);
        Route::get('/login', [ 'as' => 'login', 'uses' => 'AuthController@getLogin' ]);
        Route::get('/dashboard', ['as' => 'dashboard', 'uses' => 'AuthController@getDashboard']);
        
        Route::middleware(['admin_auth'])->get('/abc', function(){
            echo "vao trang ma khong can login ABC";
        });
        Route::middleware(['admin_auth'])->get('/abcd', function(){
            echo "vao trang ma khong can login ABCD";
        });
         
    });
   Route::get('admin/logout', [ 'uses' => 'AuthController@getLogout' ]);
   
    
});
