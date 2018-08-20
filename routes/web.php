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

Route::view('/', 'welcome');
Route::get('groups/{group}/students/search', 'StudentController@search')->name('groups.students.search');
Route::resource('groups', 'GroupController');
Route::resource('groups.students', 'StudentController');
Route::resource('groups.students.marks', 'MarkController');
Route::resource('subjects', 'SubjectController');
