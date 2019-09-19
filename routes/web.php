<?php


Route::get('/', 'WelcomeController@index');


Auth::routes();


Route::group(['prefix' => 'admin'] , function () {
	  Route::get('/', 'AdminController@index')->name('admin.dashboard');
  	Route::get('dashboard', 'AdminController@index')->name('admin.dashboard');
    Route::get('edit', 'AdminController@edit')->name('admin.edit');
    Route::put('edit/{admin}', 'AdminController@update')->name('admin.update');

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

    Route::get('/subject/list', 'Admin\SubjectController@subjects')
        ->name('subject.lists');
    Route::resource('subject', 'Admin\SubjectController');
    Route::resource('course', 'Admin\CourseController');

    Route::get('/department/list', 'Admin\DepartmentController@departments')
        ->name('department.lists');
        
    Route::resource('department', 'Admin\DepartmentController');
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

    Route::get('/subjects', 'Instructor\SubjectController@index')->name('instructor.subject.index');
    Route::get('/subject/create', 'Instructor\SubjectController@create')->name('instructor.subject.create');
    Route::post('/subject/create', 'Instructor\SubjectController@store')->name('instructor.subject.store')->middleware('check.subject_entry');
         
    Route::get('/student/list', 'Instructor\SubjectController@students')->name('student.list');
});


