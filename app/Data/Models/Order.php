<?php

namespace App\Data\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

    protected $fillable = [
        'uuid',
        'order_date',
        'delivery_date',
        'adults',
        'children',
        'user_id',
        'customer',
        'is_closed',
        'note',
    ];



    protected $casts = [
        'order_date' => 'datetime',
        'delivery_date' => 'datetime',
    ];

    protected $appends = [
        'customer_name',
        'total',
    ];


    public function getCustomerNameAttribute()
    {
        $retVal = 'n.d.';
        if (null != $this->customer) {
            $retVal = $this->customer;
        } elseif (null != $this->user_id) {
            $user = User::find($this->user_id);
            if (null != $user) $retVal = $user->getDisplayName();
        }
        return $retVal;
    }

    public function getTotalAttribute(){
        $orderItems = OrderDetail::where('order_id', $this->id)->get();
        $total = 0;
        foreach($orderItems as $orderItem){
            $total += $orderItem->item_total;
        }
        return  number_format((float) $total, 2);   
    }

    public function getPaydAttribute(){
        $payments = OrderPayment::where('order_id', $this->id)->get();
        $total = 0;
        foreach($payments as $payment){
            $total += $payment->amount;
        }
        return  number_format((float) $total, 2);
    }


    public static function CountAll($filter_dates = null)
    {
        if (null == $filter_dates) return Order::all()->count();
        return Order::whereBetween('order_date', [($filter_dates->start_date . ' ' . $filter_dates->start_time), ($filter_dates->end_date . ' ' . $filter_dates->end_time)])->count();
    }



    public function tables()
    {
        return $this->belongsToMany(Table::class, 'order_tables', 'order_id', 'table_id');
    }

    public function items()
    {
        return $this->belongsToMany(Menu::class, 'order_details', 'order_id', 'item_id');
    }

    public function payments()
    {
        return $this->hasMany(OrgerPayment::class, 'order_id', 'id');
    }
}
