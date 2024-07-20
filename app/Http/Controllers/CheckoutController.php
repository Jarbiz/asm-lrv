<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Product;
use App\Models\Order;
use App\Models\Orderdetail;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function showCheckout(){
        $cart = session()->get('cart');
        if (!is_array($cart)) {
            // Nếu không phải mảng, gán cho $cart là một mảng trống
            $cart = [];
        }
        $product_id = array_keys($cart);
        $products = Product::whereIn('id',$product_id)->get();
        return view('checkout', compact('products')); 
    }
    public function checkout(Request $request){
        $cart = session()->get('cart');
        if (!is_array($cart)) {
            // Nếu không phải mảng, gán cho $cart là một mảng trống
            $cart = [];
        }
        $product_id = array_keys($cart);
        $products = Product::whereIn('id',$product_id)->get();
        return view('checkout', compact('products')); 
    }
    public function allCheckout(Request $request){
        $cart = session()->get('cart');
        $order = new Order();
        $order->name = $request->lastName. ' ' .$request->firstName;
        $order->phone = $request->phone;
        $order->address = $request->address;
        $order->email = $request->email;
        $order->payment_method = 'Tiền Mặt';
        $order->buy_date = now();
        $order->user_id = Auth::id();
        $order->save();

        $product_id = array_keys($cart);
        $products = Product::whereIn('id',$product_id)->get();
        // dd($products);
        foreach($products as $item){
        $order_detail = new Orderdetail();
        $order_detail->product_id = $item->id;
        $order_detail->price = $item->price*$cart[$item->id];
        $order_detail->quantity = $cart[$item->id];
        $order_detail->order_id = $order->id;
        $order_detail->save();
        }

        session()->forget('cart');
        return redirect()->route('showCheckout')->with('success','Đơn hàng đã được đặt thành công.'); 
    }
}
