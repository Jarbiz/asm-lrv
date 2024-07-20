<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Orderdetail;

class OrderController extends Controller
{
    public function order(){
        $orders = Order::orderBy('id','desc')->get();
        return view('admin.orders', compact('orders'));
    }

    public function orderDetail($id){
        $order = Order::where('id', $id)->with(['user'])->first(); 
        $orderdetail = Orderdetail::with(['product', 'order'])->where('order_id',$id)->get();

        return view('admin.orderdetail', compact('orderdetail', 'order') );
    }
}
