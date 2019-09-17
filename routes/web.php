<?php


Route::get('/', 'WelcomeController@index');


Auth::routes();


Route::group(['prefix' => 'admin'] , function () {
	  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
  	Route::get('login', 'Auth\AdminLoginController@login')->name('admin.auth.login');
  	Route::post('login', 'Auth\AdminLoginController@loginAdmin')->name('admin.auth.loginAdmin');
  	Route::post('logout', 'Auth\AdminLoginController@logout')->name('admin.auth.logout');
    
    Route::get('/student/list', 'Admin\StudentController@students')
        ->name('student.lists');
    Route::resource('student', 'Admin\StudentController');

    Route::get('/student/{student}/subject/create', 'Admin\StudentSubjectController@create')
        ->name('student.subject.create');

    Route::post('/student/{student}/subject/create', 'Admin\StudentSubjectController@store')
        ->name('student.subject.store');

    Route::get('/student/{student}/subject/edit', 'Admin\StudentSubjectController@edit')
        ->name('student.subject.edit');

    Route::get('/instructor/list', 'Admin\InstructorController@instructors')
        ->name('instructor.lists');
    Route::resource('instructor', 'Admin\InstructorController');
});

Route::group(['prefix' => 'student'] , function () {
	Route::get('/', 'StudentController@index')->name('student.dashboard');
  	Route::get('dashboard', 'StudentController@index')->name('student.dashboard');
  	Route::get('login', 'Auth\StudentLoginController@login')->name('student.auth.login');
  	Route::post('login', 'Auth\StudentLoginController@loginStudent')->name('student.auth.loginStudent');
  	Route::post('logout', 'Auth\StudentLoginController@logout')->name('student.auth.logout');
});

Route::group(['prefix' => 'instructor'] , function () {
	Route::get('/', 'InstructorController@index')->name('instructor.dashboard');
  	Route::get('dashboard', 'InstructorController@index')->name('instructor.dashboard');
    
  	Route::get('login', 'Auth\InstructorLoginController@login')->name('instructor.auth.login');
  	Route::post('login', 'Auth\InstructorLoginController@loginInstructor')->name('instructor.auth.loginInstructor');
  	Route::post('logout', 'Auth\InstructorLoginController@logout')->name('instructor.auth.logout');
});


