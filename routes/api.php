<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->group(function()
{
    Route::get('/user/{id}', function (Request $request) {
        return $request->user();
    });

    Route::resource('reports', 'ReportController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('journals', 'JournalController');
    Route::resource('articles', 'ArticleController');
    Route::get('/search/single/{type}/{id}', 'SearchController@getSingle');
    Route::post('/search', 'SearchController@search');

});


