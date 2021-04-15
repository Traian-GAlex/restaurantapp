<?php

use Illuminate\Support\Facades\Route;
Route::prefix("management")->middleware('role:Admin')->group(function(){

    Route::get('', "Management\ManagementController@index")->name('management');
    Route::resource('category', "Management\CategoryController");
    Route::resource('menu', "Management\MenuController");
    Route::resource('table', "Management\TableController");
    Route::resource('role', "Management\RoleController");
    Route::resource('user', "Management\UserController");

});
