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

Auth::routes();

Route::get('/', function () {
    if(Auth::check())
    return redirect('/');
    else 
    return view('auth/login');
});

Route::group(['middleware' => ['auth']], function(){
    Route::get('user/profile', 'UserController@edit');
    Route::patch('user', 'UserController@update');

    // Posts URLS
    Route::resource('Post', 'PostController');
    Route::get('user/Posts', 'PostController@userPosts');
    Route::get('user/{id}/posts','PostController@userFriendPosts');

    // Like
    Route::resource('like', 'LikeController');

    // Comments Urls
    Route::resource('Comment', 'CommentController');

    # USERS URLS{{str::limit($post['body'], 30)}}{{str::limit($post['body'], 30)}}
    Route::get('users', 'UserController@index');
    Route::get('user_info/{id}', 'UserController@user_info');
    Route::get('search', 'UserController@autocomplete');

    # Follow URLS
    Route::resource('follow', 'FollowController');
    Route::get('user/followers', 'FollowController@index');

    Route::get('/home', 'PostController@index')->name('home');


});


Auth::routes();


