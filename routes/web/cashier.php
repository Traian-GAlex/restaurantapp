<?php

use Illuminate\Support\Facades\Route;

Route::get("/", "Cashier\CashierController@index")->name("cashier");

Route::get("/{id}/view", "Cashier\CashierController@show")->name("cashier_show");


// ajax calls
Route::get("/get/tables", "Cashier\CashierController@get_tables");
Route::get("/get/order/{id}/items", "Cashier\CashierController@get_order_items");
Route::get("/get/order/{id}/tables", "Cashier\CashierController@get_order_tables");
Route::get("/get/order/{id}/payments", "Cashier\CashierController@get_order_payments");


