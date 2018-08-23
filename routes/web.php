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

Route::get('/', 'HomeController@index');
Route::post('groups/{group}/students/{student}/addPhoto', 'StudentController@addPhoto')
    ->name('groups.students.addPhoto');
Route::resource('groups', 'GroupController');
Route::resource('groups.students', 'StudentController');
Route::resource('groups.students.marks', 'MarkController');
Route::resource('subjects', 'SubjectController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
