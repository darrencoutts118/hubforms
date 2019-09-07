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

use App\Models\Form;

Route::get('/', function () {
    return redirect()->route('form', Form::first());
});

Route::get('/form/{form}', 'FormController@show')->name('form');
Route::post('/form/{form}', 'FormController@store')->name('form.submit');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['namespace' => 'Admin', 'prefix' => 'admin/', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    Route::resource('forms', 'FormController');

});
