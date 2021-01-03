<?php


//Route::view('/', 'pages.index');
Route::get('/','HelloController@index');


Route::get('/contact','HelloController@contact')->name('contact');
Route::get('/about','HelloController@about')->name('about');


//Category Crud are here

Route::get('/add/category','PostController@addCategory')->name('add.category');
Route::get('/all/category','PostController@allCategory')->name('all.category');
Route::post('/store/category','PostController@storeCategory')->name('store.category');
Route::get('view/category/{id}','PostController@viewCategory');
Route::get('delete/category/{id}','PostController@deleteCategory');
Route::get('edit/category/{id}','PostController@editCategory');
Route::post('update/category/{id}','PostController@updateCategory');


//post crud here
Route::get('/write/post','PostimController@writePost')->name('write.post');
Route::post('store/post','PostimController@storePost')->name('store.post');
Route::get('/all/post','PostimController@allPost')->name('all.post');
Route::get('/view/post/{id}','PostimController@viewPost');
Route::get('edit/post/{id}','PostimController@editPost');
Route::post('update/post/{id}','PostimController@updatePost');
Route::get('delete/post/{id}','PostimController@deletePost');



