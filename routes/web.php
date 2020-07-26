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
// publicly show
Route::get('/', 'HomeController@index')->name('home');
Route::get('/post-detail/{id}', 'HomeController@post_detail')->name('post-detail');
// search
Route::post('/search', 'HomeController@search')->name('search');
// filter
Route::get('/postsbycategory/{id}', 'HomeController@postsbycategory')->name('postsbycategory');
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  // Posts
  Route::get('/posts', 'PostController@index')->name('posts');
  Route::get('/createpost', 'PostController@create')->name('createpost');
  Route::post('/storepost', 'PostController@store')->name('storepost');
  Route::get('/editpost/{id}', 'PostController@edit')->name('editpost');
  Route::put('/updatepost/{id}', 'PostController@update')->name('updatepost');
  Route::delete('/deletepost/{id}', 'PostController@destroy')->name('deletepost');

});

// Admin
Route::middleware(['auth','isadmin'])->namespace('admin')->group(function () {
  Route::get('/admin','DashboardController@index')->name('admin');
  // Categories
  Route::get('/admin/categories','CategoryController@index')->name('admin.categories');
  Route::get('/admin/createcategory', 'CategoryController@create')->name('admin.createcategory');
  Route::post('/admin/storecategory', 'CategoryController@store')->name('admin.storecategory');
  Route::get('/admin/editcategory/{id}', 'CategoryController@edit')->name('admin.editcategory');
  Route::put('/admin/updatecategory/{id}', 'CategoryController@update')->name('admin.updatecategory');
  Route::delete('/admin/deletecategory/{id}', 'CategoryController@destroy')->name('admin.deletecategory');
  // Posts
  Route::get('/admin/posts', 'PostController@index')->name('admin.posts');
  Route::get('/admin/createpost', 'PostController@create')->name('admin.createpost');
  Route::post('/admin/storepost', 'PostController@store')->name('admin.storepost');
  Route::get('/admin/editpost/{id}', 'PostController@edit')->name('admin.editpost');
  Route::put('/admin/updatepost/{id}', 'PostController@update')->name('admin.updatepost');
  Route::delete('/admin/deletepost/{id}', 'PostController@destroy')->name('admin.deletepost');
  // Users
  Route::get('/admin/users', 'UserController@index')->name('admin.users');
  Route::get('/admin/edituser/{id}', 'UserController@edit')->name('admin.edituser');
  Route::put('/admin/updateuser/{id}', 'UserController@update')->name('admin.updateuser');
  Route::delete('/admin/deleteuser/{id}', 'UserController@destroy')->name('admin.deleteuser');
});
