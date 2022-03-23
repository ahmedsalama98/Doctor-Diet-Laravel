<?php

use App\Http\Controllers\Admin\Admin\AdminController;
use App\Http\Controllers\Admin\AdminAccount\AdminAccountController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\AuthController;
use App\Http\Controllers\Admin\Contact\ContactController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Admin\Dashboard\DashboardController;
use App\Http\Controllers\Admin\Food\FoodCategoryController;
use App\Http\Controllers\Admin\Food\FoodController;
use App\Http\Controllers\Admin\Meal\MealCategoryController;
use App\Http\Controllers\Admin\Meal\MealController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\User\UserController;

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


// Auth::routes();

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){ //...



        // Dashboard
        Route::get('/admin',[DashboardController::class,'index'])->name('dashboard');

        Route::controller(AdminAccountController::class)->group(function(){
            Route::get('/admin/account','account')->name('dashboard.account');
            Route::get('/admin/account/edit','editAccount')->name('dashboard.account.edit');
            Route::put('/admin/account/update','updateAccount')->name('dashboard.account.update');
            Route::get('/admin/account/edit/password','editPassword')->name('dashboard.account.edit.password');
            Route::put('/admin/account/update/password','updatePassword')->name('dashboard.account.update.password');
        });




        Route::prefix('admin')->name('admin.')->group(function(){

        // Auth
        Route::get('login', [AuthController::class,'index'])->name('login');
        Route::post('login', [AuthController::class,'login'])->name('login.store');
        Route::get('logout', [AuthController::class,'logout'])->name('logout');

        // Admins

        Route::controller(AdminController::class)->group(function(){

            Route::get('/admins', 'index')->name('admins.index');
            Route::get('/admins/create', 'create')->name('admins.create');
            Route::post('/admins/store', 'store')->name('admins.store');
            Route::get('/admins/{id}/edit', 'edit')->name('admins.edit');
            Route::put('/admins/{id}/update', 'update')->name('admins.update');
            Route::delete('/admins/{id}/destroy', 'destroy')->name('admins.destroy');
        });
        // Admins

        // users

        Route::controller(UserController::class)->group(function(){

            Route::get('/users', 'index')->name('users.index');
            Route::get('/users/create', 'create')->name('users.create');
            Route::post('/users/store', 'store')->name('users.store');
            Route::get('/users/{id}/edit', 'edit')->name('users.edit');
            Route::put('/users/{id}/update', 'update')->name('users.update');
            Route::delete('/users/{id}/destroy', 'destroy')->name('users.destroy');
        });

        // users

        // food categories

        Route::controller(FoodCategoryController::class)->group(function(){

            Route::get('/food_categories', 'index')->name('food_categories.index');
            Route::get('/food_categories/create', 'create')->name('food_categories.create');
            Route::post('/food_categories/store', 'store')->name('food_categories.store');
            Route::get('/food_categories/{id}/edit', 'edit')->name('food_categories.edit');
            Route::put('/food_categories/{id}/update', 'update')->name('food_categories.update');
            Route::delete('/food_categories/{id}/destroy', 'destroy')->name('food_categories.destroy');
        });
       // food categories

    // meal categories

        Route::controller(MealCategoryController::class)->group(function(){

            Route::get('/meal_categories', 'index')->name('meal_categories.index');
            Route::get('/meal_categories/create', 'create')->name('meal_categories.create');
            Route::post('/meal_categories/store', 'store')->name('meal_categories.store');
            Route::get('/meal_categories/{id}/edit', 'edit')->name('meal_categories.edit');
            Route::put('/meal_categories/{id}/update', 'update')->name('meal_categories.update');
            Route::delete('/meal_categories/{id}/destroy', 'destroy')->name('meal_categories.destroy');
        });
       // meal categories


        // foods

           Route::controller(FoodController::class)->group(function(){

            Route::get('/foods', 'index')->name('foods.index');
            Route::get('/foods/create', 'create')->name('foods.create');
            Route::post('/foods/store', 'store')->name('foods.store');
            Route::get('/foods/{id}/edit', 'edit')->name('foods.edit');
            Route::put('/foods/{id}/update', 'update')->name('foods.update');
            Route::delete('/foods/{id}/destroy', 'destroy')->name('foods.destroy');
        });
       //  foods


        // meals

        Route::controller(MealController::class)->group(function(){

            Route::get('/meals', 'index')->name('meals.index');
            Route::get('/meals/create', 'create')->name('meals.create');
            Route::post('/meals/store', 'store')->name('meals.store');
            Route::get('/meals/{id}/edit', 'edit')->name('meals.edit');
            Route::put('/meals/{id}/update', 'update')->name('meals.update');
            Route::delete('/meals/{id}/destroy', 'destroy')->name('meals.destroy');
        });
       //  meals

    //    settings

    Route::controller(SettingController::class)->group(function(){
        Route::get('/settings', 'index')->name('settings.index');
        Route::put('/settings/update', 'update')->name('settings.update');
    });
    //    settings

    //    contacts

    Route::controller(ContactController::class)->group(function(){
        Route::get('/contacts', 'index')->name('contacts.index');
        Route::put('/contacts/{id}/read', 'read')->name('contacts.read');
        Route::delete('/contacts/{id}/destroy', 'destroy')->name('contacts.destroy');

    });
    //    contacts



        });











    });

