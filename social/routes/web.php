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



