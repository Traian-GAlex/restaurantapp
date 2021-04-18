<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "Cashier\CashierController@index")->name("cashier");
Route::post("/", "Cashier\CashierController@index")->name("filtered_cashier");

Route::get("/get-tables", "Cashier\CashierController@get_tables");
