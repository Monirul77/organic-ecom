<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function order(){
        $orders=Order::where('user_id',Auth::id())->latest()->get();
        return view('pages.profile.view',compact('orders'));
    }


    public function orderView($order_id){
        $orders=Order::findOrFail($order_id)->latest()->get();
        $orderitems=OrderItem::with('product')->where('order_id',$order_id)->get();
        $shipping=Shipping::where('order_id',$order_id)->first();
        return view('pages.profile.order-view',compact('orders','orderitems','shipping'));

    }
}
