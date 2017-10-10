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

Route::group(['prefix' => 'admin'], function()
{

    Route::get('/', 'AdminController@showAdmin')->name('Admin');

    Route::get('edit/', 'AdminController@editArt')->name('EditArticle');

    Route::get('new-article', 'AdminController@AddArt')->name('CreateArticle');

    Route::post('edit/', 'AdminController@SaveArt')->name('SaveArticle');

    Route::get('delete/{id}', 'AdminController@DelArt')->name('DeleteArticle');

    Route::get('new-category', 'AdminController@AddCat')->name('CreateCategory');

    Route::post('addCat/', 'AdminController@saveCat')->name('SaveCategory');

});





Route::get('articles/', 'FrontController@articles')->name('ShowAllArticles');

Route::get('articles/{id}', 'FrontController@article')->name('ShowArticle');

Route::get('category', 'FrontController@ShowCat')->name('ShowAllCategories');

Route::get('category/{id}', 'FrontController@SingleCat')->name('ShowCategory');

Route::get('tags/{id}', 'FrontController@showTagArt')->name('ShowArticleWithTags');

Route::get('category/delete/{id}', 'FrontController@DelCat');


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
