<?php


Route::get('/', 'AdminController@index');


Auth::routes();


Route::group(['prefix' => 'admin'] , function () {
	  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('edit', 'AdminController@edit')->name('admin.edit');
    Route::put('edit/{admin}', 'AdminController@update')->name('admin.update');

  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');
    
  
});

Route::group(['prefix' => 'instructor'] , function () {
	  Route::get('/', 'InstructorController@index')->name('instructor.dashboard');
  	Route::get('dashboard', 'InstructorController@index')->name('instructor.dashboard');

    Route::get('edit', 'InstructorController@edit')->name('instructor.account.edit');
    Route::put('edit/{instructor}', 'InstructorController@update')->name('instructor.account.update');
    
  	Route::get('login', 'Auth\InstructorLoginController@login')->name('instructor.auth.login');
  	Route::post('login', 'Auth\InstructorLoginController@loginInstructor')->name('instructor.auth.loginInstructor');
  	Route::post('logout', 'Auth\InstructorLoginController@logout')->name('instructor.auth.logout');
});


