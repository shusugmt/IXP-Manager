<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/


$auth = Zend_Auth::getInstance();

if( $auth->hasIdentity() && \Auth::guest() ) {
    // log the user is for Laravel5
    \Auth::login( $auth->getIdentity()['user'] );
} else if( !$auth->hasIdentity() ) {
    \Auth::logout();
}

Route::group(['middleware' => ['web']], function () {
    Route::get('/test', function() {
        return view( 'test' );
    });

    Route::get('/layout', function() {
        return view( 'layout' );
    });

});
