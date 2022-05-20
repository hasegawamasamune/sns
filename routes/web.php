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

// Route::get('/', function () {
//     return view('welcome');
// });
// Route::get('/home', 'HomeController@index')->name('home');

//Auth::routes();


//ログアウト中のページ
Route::get('/login', 'Auth\LoginController@login');
Route::post('/login', 'Auth\LoginController@login');

Route::get('/register', 'Auth\RegisterController@register');
Route::post('/register', 'Auth\RegisterController@register');

Route::get('/added', 'Auth\RegisterController@added');
Route::post('/added', 'Auth\RegisterController@added');

// 認証をグループ化してログインした時にしかアクセスできないようにした。
Auth ::routes();
Route::group(['middleware' => 'auth'],function(){

//ログイン中のページ
Route::get('/top','PostsController@index');

Route::get('/profile','UsersController@profile');

Route::get('/search','UsersController@search');

Route::get('/follow-list','FollowsController@followList');
Route::get('/follower-list','FollowsController@followerList');

Route::get('/logout', 'Auth\LoginController@logout');


// 投稿処理
Route::post('posts', 'PostsController@store');

// update
Route::get('post/{id}/update-form', 'PostsController@updateForm');
Route::post('post/update', 'PostsController@update');
Route::get('post/{id}/delete', 'PostsController@delete');

// ResourceControllerにすることでシステムが自動的にそれぞれのアクションに紐づけてくれます。
Route::resource('users', 'UsersController');
    // フォロー/フォロー解除を追加
     // フォロー/フォロー解除を追加
    Route::post('users/{user}/follow', 'UsersController@follow')->name('follow');
    Route::delete('users/{user}/unfollow', 'UsersController@unfollow')->name('unfollow');
});
