<?php

use Illuminate\Support\Facades\Route;

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

// Login Form
Route::get('login', 'AdminController@login');
Route::get('logOut', 'AdminController@logout');
Route::post('doLogin', 'AdminController@doLogin');
// Admin
Route::resource('admin', 'AdminController');
Route::get('dashboard', 'AdminController@dashboard');
// Manager
Route::resource('package', 'ManagerController')->middleware('checkAuthManager');
// Coach
Route::resource('coach', 'CoachController')->middleware('checkAuthManager');
// Manager Home
Route::resource('home', 'viewHomeController')->middleware('checkAuthManager');

Route::resource('trainee', 'TraineeController')->middleware('checkAuthManager');

// Coach View
Route::resource('coachview', 'CoachViewController')->middleware('checkAuthCoach');

// Trainee View
Route::resource('traineeview', 'TraineeViewController')->middleware('checkAuthTrainee');
Route::get('exersise', 'TraineeViewController@ExersiseView')->middleware('checkAuthTrainee');
