<?php

Route::group(['module' => 'Backend', 'middleware' => ['api'], 'namespace' => 'App\Modules\Backend\Controllers'], function() {

    Route::resource('Backend', 'BackendController');

});
