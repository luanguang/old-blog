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
Route::group(['namespace' => 'Web'], function () {
    Route::resource('/', 'HomeController', ['only' => ['index']]);
    Route::get('user/article', 'UserController@myArticle');
    Route::resource('user', 'UserController', ['only' => ['index', 'show', 'edit', 'update']]);
    Route::post('user/{id}', 'UserController@mind');
    Route::any('user/{id}/upload', 'UserController@upload');

    Route::resource('article', 'ArticleController');
    Route::any('article/{id}/deleted', 'ArticleController@deleted');
    Route::any('article/{id}/mark', 'ArticleController@mark');

    Route::resource('article.comment', 'CommentController', ['only' => ['store']]);
    Route::any('comment/{comment_id}', 'CommentController@deleted');

    Route::resource('category', 'CategoryController', ['only' => ['index']]);

    Route::resource('mark', 'MarkController');
    Route::any('mark/{id}/deleted', 'MarkController@deleted');

    Route::resource('browse', 'BrowseController', ['only' => ['index']]);

    Route::resource('follow', 'FollowController');
    Route::any('follow/{id}/deleted', 'FollowController@deleted');
});
Route::Auth();
Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');