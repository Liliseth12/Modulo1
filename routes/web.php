<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//------Ajax Route Example------
//Route::get('employees-all', 'EmployeeController@employees');

Route::get('/', function () {
	if(auth()->user()){
		return view('home');
	}
    return view('auth.login');
    //return view('welcome');
})->name('login');


// Authentication Routes...
//Details of: Auth::routes(); ---
    Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'Auth\LoginController@login');
    Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group([
	'middleware' => 'admin'
	], function(){
    	// Registration Routes...
	    Route::post('register', 'Auth\RegisterController@register');		
	    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
	});

    // Password Reset Routes...
    Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'Auth\ResetPasswordController@reset');

Route::get('/home', 'HomeController@index')->name('home');

Route::get('admin/routes', 'HomeController@admin')->middleware('admin');

//---Data Base routes---
	//Country Routes...
	//Details of: Route::resource('countries','CountryController');
Route::group([
	'middleware' => ['admin', 'auth']], function(){
		Route::delete('countries/{country}', 'CountryController@destroy')->name('countries.destroy');
		Route::patch('countries/{country}', 'CountryController@update')->name('countries.update');
		Route::post('countries', 'CountryController@store')->name('countries.store');
		Route::get('countries/create', 'CountryController@create')->name('countries.create');
		Route::get('countries/{country}/edit', 'CountryController@edit')->name('countries.edit');
		Route::get('countries', 'CountryController@index')->name('countries.index');
		Route::get('countries/{country}', 'CountryController@show')->name('countries.show');
	});

	//Brand Routes...
	//Details of: Route::resource('brands','BrandController');
Route::group([
	'middleware' => 'auth'], function(){
		Route::delete('brands/{brand}', 'BrandController@destroy')->name('brands.destroy');
		Route::patch('brands/{brand}', 'BrandController@update')->name('brands.update');
		Route::post('brands', 'BrandController@store')->name('brands.store');
		Route::get('brands/create', 'BrandController@create')->name('brands.create');
		Route::get('brands/{brand}/edit', 'BrandController@edit')->name('brands.edit');
		Route::get('brands', 'BrandController@index')->name('brands.index');
		Route::get('brands/{brand}', 'BrandController@show')->name('brands.show');
	});

	//Customer Routes...
	//Details of: Route::resource('customers','CustomerController');
Route::group([
	'middleware' => 'auth'], function(){
		Route::delete('customers/{customer}', 'CustomerController@destroy')->name('customers.destroy');
		Route::patch('customers/{customer}', 'CustomerController@update')->name('customers.update');
		Route::post('customers', 'CustomerController@store')->name('customers.store');
		Route::get('customers/create', 'CustomerController@create')->name('customers.create');
		Route::get('customers/{customer}/edit', 'CustomerController@edit')->name('customers.edit');
	});
Route::group([
	'middleware' => 'auth'], function(){
		Route::get('customers', 'CustomerController@index')->name('customers.index');
		Route::get('customers/{customer}', 'CustomerController@show')->name('customers.show');	
	});

	//Employee Routes...
	//Details of: Route::resource('employees','EmployeeController');
Route::group([
	'middleware' => ['admin', 'auth']], function(){
		Route::delete('employees/{employee}', 'EmployeeController@destroy')->name('employees.destroy');
		Route::patch('employees/{employee}', 'EmployeeController@update')->name('employees.update');
		Route::post('employees', 'EmployeeController@store')->name('employees.store');
		Route::get('employees/create', 'EmployeeController@create')->name('employees.create');
		Route::get('employees/{employee}/edit', 'EmployeeController@edit')->name('employees.edit');
	});
Route::group([
	'middleware' => 'auth'], function(){
	Route::get('employees', 'EmployeeController@index')->name('employees.index');
	Route::get('employees/{employee}', 'EmployeeController@show')->name('employees.show');
	Route::get('employees.noactive', 'InactiveController@index');
	Route::get('employees.delete/{id}','EmployeeController@delete');	
	});

	//Department Routes...
	//Details of: Route::resource('departments','DepartmentController');
Route::group([
	'middleware' => ['admin', 'auth']], function(){
		Route::delete('departments/{department}', 'DepartmentController@destroy')->name('departments.destroy');
		Route::patch('departments/{department}', 'DepartmentController@update')->name('departments.update');
		Route::post('departments', 'DepartmentController@store')->name('departments.store');
		Route::get('departments/create', 'DepartmentController@create')->name('departments.create');
		Route::get('departments/{department}/edit', 'DepartmentController@edit')->name('departments.edit');
		Route::get('departments', 'DepartmentController@index')->name('departments.index');
		Route::get('departments/{department}', 'DepartmentController@show')->name('departments.show');		
	});

	//Project Routes...
	//Details of: Route::resource('projects','ProjectController');
Route::group([
	'middleware' => 'auth'], function(){
		Route::delete('projects/{project}', 'ProjectController@destroy')->name('projects.destroy');
		Route::patch('projects/{project}', 'ProjectController@update')->name('projects.update');
		Route::post('projects', 'ProjectController@store')->name('projects.store');
		Route::get('projects/create', 'ProjectController@create')->name('projects.create');
		Route::get('projects/{project}/edit', 'ProjectController@edit')->name('projects.edit');
		Route::get('projects', 'ProjectController@index')->name('projects.index');
		Route::get('projects/{project}', 'ProjectController@show')->name('projects.show');
	});

	//Position Routes...
	//Details of: Route::resource('positions','PositionController');
Route::group([
	'middleware' => ['admin', 'auth']], function(){
		Route::delete('positions/{position}', 'PositionController@destroy')->name('positions.destroy');
		Route::patch('positions/{position}', 'PositionController@update')->name('positions.update');
		Route::post('positions', 'PositionController@store')->name('positions.store');
		Route::get('positions/create', 'PositionController@create')->name('positions.create');
		Route::get('positions/{position}/edit', 'PositionController@edit')->name('positions.edit');
		Route::get('positions', 'PositionController@index')->name('positions.index');
	});
Route::group([
	'middleware' => 'auth'], function(){
		Route::get('positions/{position}', 'PositionController@show')->name('positions.show');
	});


	//Salaries Routes...
	//Details of: Route::resource('salaries','SalaryController');
Route::group([
	'middleware' => ['admin', 'auth']], function(){
		Route::delete('salaries/{salary}', 'SalaryController@destroy')->name('salaries.destroy');
		Route::patch('salaries/{salary}', 'SalaryController@update')->name('salaries.update');
		Route::post('salaries', 'SalaryController@store')->name('salaries.store');
		Route::get('salaries/create', 'SalaryController@create')->name('salaries.create');
		Route::get('salaries/{salary}/edit', 'SalaryController@edit')->name('salaries.edit');
	});
Route::group([
	'middleware' => 'auth'], function(){
	Route::get('salaries', 'SalaryController@index')->name('salaries.index');
	Route::get('salaries/{salary}', 'SalaryController@show')->name('salaries.show');
	Route::get('salary/{id}', 'SalaryController@show');
	});

	//DailyReport Routes...
Route::group([
	'middleware' => ['admin', 'auth']], function(){
		Route::get('import', 'DailyreportController@showimport');
		Route::post('dailyreports/import', 'DailyreportController@import')->name('importfile');
	});
Route::group([
	'middleware' => 'auth'], function(){
	Route::get('dailyreports', 'DailyreportController@index')->name('dailyreports.index');
	Route::post('dailyreports/show', 'DailyreportController@show')->name('dailyreports.addfile');
	});





