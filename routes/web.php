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

    Route::get('edit/', 'AdminController@editArticle')->name('EditArticle');

    Route::get('new-article', 'AdminController@createArticle')->name('CreateArticle');

    Route::post('edit/', 'AdminController@saveArticle')->name('SaveArticle');

    Route::get('delete/{id}', 'AdminController@deleteArticle')->name('DeleteArticle');

    Route::get('new-category', 'AdminController@createCategory')->name('CreateCategory');

    Route::post('addCat/', 'AdminController@saveCategory')->name('SaveCategory');

});


Route::get('articles/', 'FrontController@showAllArticles')->name('ShowAllArticles');

Route::get('article/{id}', 'FrontController@showArticle')->name('ShowArticle');

Route::get('category', 'FrontController@showAllCategories')->name('ShowAllCategories');

Route::get('category/{id}', 'FrontController@showCategory')->name('ShowCategory');

Route::get('tags/{id}', 'FrontController@showArticleWithTags')->name('ShowArticleWithTags');

Route::get('category/delete/{id}', 'FrontController@deleteCategory');


Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
