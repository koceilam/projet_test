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

Route::get('/user/{id}', 'EmployeeController@index'); // Route the the home page
Route::get('/user/{id_admin}/holidays/{employee_id}', 'EmployeeController@getListHolidayApproved');
Route::get('/user/{id}/add_holiday/', 'EmployeeController@addHoliday');
Route::post('/user/{id}/createByAjax', 'EmployeeController@createByAjax');
Route::get('/user/{id}/edit_holiday/{holiday_id}', 'EmployeeController@editHoliday');
Route::post('/user/{id}/updateByAjax/{holiday_id}', 'EmployeeController@updateByAjax');
Route::post('/user/{id}/updateHolidayStatus/{holiday_id}/{status}', 'EmployeeController@updateHolidayStatus');

