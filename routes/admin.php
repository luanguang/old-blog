<?php

Route::resource('/', 'HomeController', ['only' => ['index']]);
Route::resource('user', 'UserController', ['expect' => ['edit']]);

Route::resource('category', 'CategoryController', ['expect' => ['edit']]);
Route::resource('article', 'ArticleController', ['expect' => ['edit', 'create', 'store']]);
