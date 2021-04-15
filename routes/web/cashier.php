<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "Cashier\CashierController@index")->name("cashier");
Route::get("/get-tables", "Cashier\CashierController@get_tables");
