<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::post('cities/{id}/add_population', [CityController::class, 'add_population']);
Route::post('cities/{id}/remove_population', [CityController::class,'remove_population']);
Route::get('cities/search', [CityController::class, 'search_by_name']);

Route::get('get_country_population', [CountryController::class,'get_country_population']);
Route::get('countries/search', [CountryController::class, 'search_country']);
Route::get('get-country-cities/{id}', [CountryController::class,'get_country_cities']);

Route::apiResource('countries', CountryController::class);
Route::apiResource('cities', CityController::class);
