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

// API

// User
Route::post('/user/inscription', 'UserController@inscription');
Route::post('/user/connexion', 'UserController@connexion');

// Recipe
Route::get('/recipes/all', 'RecipeController@retrieve');
Route::post('/recipe/add', 'RecipeController@add');

// Ingredients
Route::get("/ingredients/all", "IngredientController@retrieve");

// APP DEPRECATED
Route::get('/connection', 'ConnectionController@showConnection');
Route::get('/deconnection', 'ConnectionController@deconnection');
Route::post('/connection', 'ConnectionController@connection');
Route::post('/inscription', 'InscriptionController@inscription');
Route::get('/inscription', 'InscriptionController@getInscription');
Route::get('/import', 'ImportController@import');
Route::get('/recipes', 'RecipeController@getList');
Route::get('/recipe/{recipeId}', 'RecipeController@get');
Route::get('/recipe/update/{recipeId}', 'RecipeController@updateGet');
Route::post('/recipe/update/{recipeId}', 'RecipeController@updatePost');
Route::get('/generator', 'GeneratorController@generate');
Route::post('/historic/save', 'HistoricController@save');
