<?php

Route::group([
	'module' => 'Frontend', 
	'middleware' => ['web'], 
	'namespace' => 'App\Modules\Frontend\Controllers'], 
	function() {

		Route::get('/', ['as' => '/', 'uses' => 'AuthController@getIndex']);
		Route::post('/login', ['as' => 'login', 'uses' => 'AuthController@postLogin']);
	    Route::get('/login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
	    Route::get('/logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);

		Route::get('/abc', function () {
		    echo "Hello ABC. <a href='" . url('/logout') . "'>Logout</a>";
		})->middleware(['employee_auth']);
		Route::get('/abcd', function () {
		    echo "Hello ABCD. <a href='" . url('/logout') . "'>Logout</a>";
		})->middleware(['employee_auth']);

});
