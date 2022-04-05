<?php

use App\Http\Controllers\Api\Auth\AuthController;
use App\Http\Controllers\Api\Food\FoodApiController;
use App\Http\Controllers\Api\Meal\MealApiController;
use App\Http\Controllers\Api\User\WeightController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


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


Route:: group(['prefix' =>'api','middleware' => 'changeLangApi'],function(){


    // start api routes

    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    //     return App::getLocale();

    // });

    Route::get('/test', function (Request $request) {

        return App::getLocale();

    });

    Route::controller(AuthController::class)->group(function(){
       // Auth
        Route::post('login','login');
        Route::post('signup','signUp');
        Route::post('/user/edit-information','editInfo');
        Route::post('/user/edit-password','updatePassword');
        Route::post('/user/edit-avatar','updateImage');

        Route::delete('logout','logOut');
        Route::get('user','user');

        // Auth
    });

    Route::controller(WeightController::class)->group(function(){
        Route::get('user/weights','index');
        Route::post('user/weight/store','create');
        Route::delete('user/weight/{id}/destroy','destroy');

    });
    Route::controller(FoodApiController::class)->group(function(){
        Route::get('user/food-search-for-add-new-meal','searchForAddNewMeal');
        Route::get('food-categories','getFoodsCategories');
        Route::get('foods','index');
        Route::get('foods/{id}','getFoodById');




    });

    Route::controller(MealApiController::class)->group(function(){
        Route::get('meal-categories','getMealsCategory');
        Route::get('user/meals','getMeals');
        Route::get('user/today-meals','getTodayMeals');
        Route::delete('user/today-meal/{id}/destroy','destroy');
        Route::post('user-meals/store','storeUserMeal');


    });



    // end api routes

});












