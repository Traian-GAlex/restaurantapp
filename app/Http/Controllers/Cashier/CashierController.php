<?php

namespace App\Http\Controllers\Cashier;

use App\Data\Models\Order;
use App\Data\Models\Table;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CashierController extends Controller
{
    public function index(Request $request){
        $crtDate = new \DateTime();
        $start_date = (null == $request->start_date) ? $crtDate->format('Y-m-d'): $request->start_date;
        $start_time = (null == $request->start_time) ? '00:00': $request->start_time;
        $end_date = (null == $request->end_date) ? $crtDate->format('Y-m-d'): $request->end_date;
        $end_time = (null == $request->end_time) ? '23:59': $request->end_time;

        $orders = Order::whereBetween('order_date', [($start_date . ' ' . $start_time), ($end_date . ' ' . $end_time)])->get();

        return view("cashier.index")
            ->with('start_date', $start_date)
            ->with('start_time', $start_time)
            ->with('end_date', $end_date)
            ->with('end_time', $end_time)
            ->with('orders', $orders);
    }



    public function get_tables(Request $request){
        $tables = Table::orderByRaw("available desc, name")->get();
        return view("cashier.include.table_list")->with("tables", $tables);
    }
}
