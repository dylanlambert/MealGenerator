<?php

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

Route::get('/', 'HomeController@get');
Route::get('/import', 'ImportController@import');
Route::get('/recipes', 'RecipeController@getList');
Route::post('/recipe', 'RecipeController@register');
Route::get('/recipe/{recipeId}', 'RecipeController@get');
Route::get('/generator', 'GeneratorController@generate');
