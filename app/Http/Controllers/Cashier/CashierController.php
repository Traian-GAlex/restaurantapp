<?php

namespace App\Http\Controllers\Cashier;

use App\Data\Models\Order;
use App\Data\Models\OrderDetail;
use App\Data\Models\Table;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomController;
use Illuminate\Http\Request;

class CashierController extends CustomController
{
    public function index(Request $request){
        $d = $this::getFilterDates();
        $orders = Order::whereBetween('order_date', [($d->start_date . ' ' . $d->start_time), ($d->end_date . ' ' . $d->end_time)])->orderBY('order_date', 'desc')->paginate($this->getItemsPerPage());

        return view("cashier.index")
            ->with('start_date', $d->start_date)
            ->with('start_time', $d->start_time)
            ->with('end_date', $d->end_date)
            ->with('end_time', $d->end_time)
            ->with('orders', $orders)
            ->with('all_rows', Order::CountAll($d));
    }

    public function show(Request $request, $id){
        $order = Order::find($id);

        return view("cashier.view")
            ->with("order", $order);

    }


    // ajax call
    public function get_tables(Request $request){
        $tables = Table::orderByRaw("available desc, name")->get();
        return view("cashier.include.table_list")->with("tables", $tables);
    }

    public function get_order_items(Request $request, $id){
        $order_items = OrderDetail::where('order_id', $id)->get();
        return view("cashier.include.order_items_view")->with("order_items", $order_items);
    }
}
