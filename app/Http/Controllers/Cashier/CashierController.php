<?php

namespace App\Http\Controllers\Cashier;

use App\Data\Models\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(Request $request){
        return view("cashier.index");
    }

    public function get_tables(Request $request){
        $tables = Table::orderByRaw("available desc, name")->get();
        return view("cashier.include.table_list")->with("tables", $tables);
    }
}
