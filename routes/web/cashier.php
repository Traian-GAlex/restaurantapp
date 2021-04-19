<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "Cashier\CashierController@index")->name("cashier");

Route::get("/{id}/view", "Cashier\CashierController@show")->name("cashier_show");

Route::get("/get-tables", "Cashier\CashierController@get_tables");
