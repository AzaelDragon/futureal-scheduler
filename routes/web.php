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

Route::get('/', function () {
    return view('welcome');
}) -> name('welcome');

Auth::routes();

Route::get('/home', 'HomeController@index') -> name('home');

Route::resource('rooms', 'RoomController') -> except(['create', 'show', 'edit']);

Route::resource('buildings', 'BuildingController') -> except(['create', 'show', 'edit']);

Route::resource('subjects', 'SubjectController') -> except(['create', 'show', 'edit']);

Route::resource('schedules', 'ScheduleController') -> except(['create', 'show', 'edit']);

Route::get('/schedules/calendar', 'ScheduleController@calendar') -> name('schedules.calendar');

Route::get('/my-profile', 'ProfileController@index') -> name('profile');
Route::post('/profile/name', 'ProfileController@updateName') -> name('profile.name');
Route::post('/profile/email', 'ProfileController@updateEmail') -> name('profile.email');
Route::post('/profile/password', 'ProfileController@updatePassword') -> name('profile.password');
