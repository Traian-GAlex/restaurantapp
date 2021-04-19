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

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/reports', function(){
    return view('reports.index');
})->name('reports')->middleware("role:Admin");

Route::get('/options/rows-per-page/{numXPage}', function($numXPage){
    CustomController::setItemsPerPage((int) $numXPage);
    return response([
        'value' => $numXPage,
        'sessionValue' => session("itemsPerPage")
    ],200);
});

Route::post('/options/set_filter_dates', function(Request $request){
    CustomController::setFilterDates($request);
    return response([
        'data' => CustomController::getFilterDates(),
    ],200);
});


