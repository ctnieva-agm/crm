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
    if(\Auth::check())
        return redirect()->intended('home');
    else 
        return view('home.login');
})->name('login');

Route::resource('login', 'LoginController')
    ->only('index', 'store')
    ->middleware('guest');

Route::get('logout', function(){
    \Auth::logout();
    return redirect('/');
})->name('logout');

Route::middleware(['auth'])->prefix('home')->group(function(){
    Route::get('/', 'HomeController@view')->name('home');
    
    Route::get('/source', 'HomeController@source')->name('home.source');
    Route::get('/source/contacts', 'HomeController@sourceContacts')->name('home.source_contacts');
});

Route::middleware(['auth'])->prefix('contact')->group(function(){
    Route::post('/', 'ContactController@store')->name('contact.store');
    Route::post('/import', 'ContactController@import')->name('contact.import');
});



