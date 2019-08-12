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


Route::resourceVerbs([
    'create' => 'novo',
    'edit' => 'editar',
]);

Route::get('clients/export', 'ClientController@export')->name('clients.export');
Route::get('clients/import', 'ClientController@import')->name('clients.import');
Route::post('clients/send', 'ClientController@send')->name('clients.send');
Route::get('clients/mail', 'ClientController@mail')->name('clients.mail');
Route::resource('clients', 'ClientController');

Route::get('/', 'ClientController@index');