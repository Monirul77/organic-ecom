<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishController extends Controller
{
    
    public function addToWish($product_id){

        if(Auth::check()) 
        {
            Wishlist::create([

                'user_id'=>Auth::id(),
                'product_id'=>$product_id
            ]);
    
            return redirect()->back()->with('cart','product add on wishlist');

        }else{
            return redirect()->back('login')->with('login','You are not authenticate please login ');
        }
         

    }

    //==========================wishlistpage show=====================================

    public function wishShow(){
        $wishlists=Wishlist::where('user_id',Auth::id())->latest()->get();
        return view('pages.wishlist',compact('wishlists'));
    }


    //====================wishlist destroy===============================

    public function destroy($wishlist_Id){
        Wishlist::where('id',$wishlist_Id)->where('user_id',Auth::id())->delete();
        return Redirect()->back()->with('cart_delete','Wishist Product Removed');
    }
}
