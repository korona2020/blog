<?php

use Illuminate\Support\Facades\Auth;
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

Route::group(['middleware'=>['auth']], function(){
    Route::get('/home', 'HomeController@index')->name('home');
    Route::resource('/categories','CategoriesController');
    Route::resource('/tags','TagsController');
    Route::resource('/posts','PostsController');
    Route::get('/trashed_posts','PostsController@trashed')->name('posts.trash');
    Route::put('/restore/{id}','PostsController@restore')->name('posts.restore');
    Route::resource('/roles','RolesController')->middleware('checkrole');
    Route::resource('/users','UsersController')->middleware('checkrole');
});



