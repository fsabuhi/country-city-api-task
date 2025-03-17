<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CountryController;
use App\Http\Controllers\CityController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('countries', CountryController::class);
Route::apiResource('cities', CityController::class);
Route::apiResource('search_city', CityController::class,'search_by_name');
