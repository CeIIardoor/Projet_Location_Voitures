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
});

Route::get('/home','App\Http\Controllers\BookingController@showHome')->name('home');
Route::post('/cars/list','App\Http\Controllers\BookingController@handleSearchCars')->name('handleSearchCars');

Route::get('/cars/booking/{id}/{pickUp}/{dropOff}', 'App\Http\Controllers\BookingController@showBookingCar')->name('showBookingCar');
Route::post('/cars/booking/{id}/{pickUp}/{dropOff}', 'App\Http\Controllers\BookingController@handleBookingCar')->name('handleBookingCar');


Route::get('/about', 'App\Http\Controllers\BookingController@showAbout')->name('about');
Route::get('/service', 'App\Http\Controllers\BookingController@showService')->name('service');


Route::get('/cars/list','App\Http\Controllers\CarController@showCarsList')->name('showCarsList');
Route::get('/cars/viewByMark/{id}','App\Http\Controllers\CarController@showCarsByMark')->name('showCarsByMark');



Route::get('/contact','App\Http\Controllers\UserController@showContact')->name('showContact');
Route::post('/contact','App\Http\Controllers\UserController@handleContact')->name('handleContact');

Route::get('/users/add','App\Http\Controllers\UserController@showAddUser')->name('showAddUser');
Route::post('/users/add','App\Http\Controllers\UserController@handleAddUser')->name('handleAddUser');
Route::post('/users/account', 'App\Http\Controllers\UserController@handleUpdateUser')->name('handleUpdateUser');


Route::get('/users/login','App\Http\Controllers\UserController@showUserLogin')->name('showUserLogin');
Route::post('/users/login','App\Http\Controllers\UserController@handleUserLogin')->name('handleUserLogin');
Route::get('/users/logout','App\Http\Controllers\UserController@handleUserLogout')->name('handleUserLogout');



Route::post('/cars/add','App\Http\Controllers\CarController@handleAddCar')->name('handleAddCar');
Route::get('/admin/delete/{id}','App\Http\Controllers\CarController@handleDeleteCar')->name('handleDeleteCar');
Route::post('/cars/addMark','App\Http\Controllers\CarController@handleAddMark')->name('handleAddMark');

Route::get('/admin/confirm/{id}','App\Http\Controllers\BookingController@handleBookingConfirm')->name('handleBookingConfirm');
  Route::get('/admin/refuse/{id}','App\Http\Controllers\BookingController@handleBookingRefuse')->name('handleBookingRefuse');
  Route::get('/admin/clear/{id}','App\Http\Controllers\BookingController@handleBookingClear')->name('handleBookingClear');

 Route::middleware(['isAdmin'])->group(function () {
 	  Route::get('/cars/add','App\Http\Controllers\CarController@showAddCar')->name('showAddCar');
  	Route::get('/admin/delete','App\Http\Controllers\CarController@showDeleteCar')->name('showDeleteCar');
	  Route::get('/cars/addMark','App\Http\Controllers\CarController@showAddMark')->name('showAddMark');
	
  	Route::get('/admin/check', 'App\Http\Controllers\BookingController@showCheckBooking')->name('showCheckBooking');	
    Route::get('/admin/history', 'App\Http\Controllers\BookingController@showHistoryBooking')->name('showHistoryBooking'); 
});


  Route::middleware(['isUser'])->group(function () {
  	Route::get('/users/list', 'App\Http\Controllers\BookingController@showBookingsList')->name('showBookingsList');
  	Route::get('/users/payement', 'App\Http\Controllers\BookingController@showPaymentBooking')->name('showPaymentBooking');
  	Route::get('/users/account', 'App\Http\Controllers\UserController@showUpdateUser')->name('showUpdateUser');
  });

  

