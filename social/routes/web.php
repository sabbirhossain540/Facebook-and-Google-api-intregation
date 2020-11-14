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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/login/google', 'Auth\LoginController@redirectToProvider')->name('google_login');
Route::get('/login/google/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/login/github', 'Auth\LoginController@redirectToProviderForGithub')->name('github_login');
Route::get('/login/github/callback', 'Auth\LoginController@handleProviderCallbackForGithub');

Route::get('/calender', 'GoogleCalenderController@index')->name('calender');
Route::get('/google_drive', 'GoogleDriveController@getDrive')->name('google_drive');
Route::get('/google_map', 'GoogleMapController@index')->name('google_map');
Route::get('/youtube', 'YoutubeController@index')->name('youtube');


//Using this URL for Google Drive
Route::get('/drive', 'GoogleDriveController@getDrive'); // retreive folders
Route::get('/drive/upload', 'GoogleDriveController@uploadFile'); // File upload form
Route::post('/drive/upload', 'GoogleDriveController@uploadFile'); // Upload file to Drive from Form
Route::get('/drive/create', 'GoogleDriveController@create'); // Upload file to Drive from Storage
Route::get('/drive/delete/{id}', 'GoogleDriveController@deleteFile'); // Delete file or folder


