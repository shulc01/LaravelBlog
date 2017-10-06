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

Route::get('articles/', 'MyController@articles')->name('Articles');

Route::get('articles/{id}', 'MyController@article')->name('showArticle');

Route::get('admin', 'AdminController@showAdmin')->name('Admin');

Route::get('admin/edit/', 'AdminController@editArt')->name('EditArticle');

Route::get('admin/addArticle/', 'AdminController@AddArt')->name('AddArticle');

Route::post('admin/edit/', 'AdminController@SaveArt')->name('saveArticle');

Route::get('admin/delete/{id}', 'AdminController@DelArt')->name('DeleteArticle');

Route::get('category', 'MyController@ShowCat')->name('Allcategories');

Route::get('category/{id}', 'MyController@SingleCat')->name('SingleCat');

Route::get('tags/{id}', 'MyController@showTagArt')->name('showTags');

Route::get('admin/addCat/', 'AdminController@AddCat')->name('AddCat');

Route::post('admin/addCat/', 'AdminController@saveCat')->name('saveCat');


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
