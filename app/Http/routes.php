<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::resource('continents', 'admin\ContinentController');
Route::resource('countries', 'admin\CountryController');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dragndrop', function () {
    return view('dragndrop');
});

Route::get('/entry', function () {
    return view('entry');
});

Route::get('overview', ['uses' => 'HomeController@index', 'as' => 'home']);

Route::get('country/{id}/{type?}', ['uses' => 'DetailsController@show', 'as' => 'detail']);


Route::get('getStatisticDetails', ['uses' => 'DetailsController@getStatisticDetails', 'as' => 'statisticdetail']);

Route::get('statistics', ['uses' => 'DetailsController@getStatisticDetailsByType', 'as' => 'type']);

Route::get('compare/{id}', ['uses' => 'ComparisonController@show', 'as' => 'comparison']);

Route::get('/charts', function () {
    return view('charts');
});
