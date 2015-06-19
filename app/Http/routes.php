<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


use Illuminate\Http\Request;



Route::group(['prefix' => 'api/v1'], function(){

	Route::get('tasks/{id}/labels', 'LabelsController@index');
	Route::resource('projects', 'ProjectsController');
	Route::resource('tasks', 'TasksController');
    Route::resource('labels', 'LabelsController');
	Route::get('login', 'AuthController@login');

});


/*
Route::group(['domain'=>'api.fourfusa.com'], function(){

    Route::get('/', function() 
    { 
    	return redirect()->to('api/v1/tasks');
        //return 'Hello from my subdomain!'; 
    });

});
*/



Route::get('/', function (Request $request) {
    
    //return redirect()->to('api/v1/tasks');

	if(Auth::check())
	{
		return 'Welcome back, ' . Auth::user()->username;
	} 

	return 'Hi guest. ' ;//. link_to('login', 'Login with Gihub!');

    //return view('welcome');


});

