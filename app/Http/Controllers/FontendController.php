<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FontendController extends Controller
{
    public function index(){

       $products= Product::where('status','1')->latest()->get();
       $lts_p = Product::where('status',1)->latest()->limit(3)->get();
       $categories=Category::where('status','1')->latest()->get();
       $search=Product::where('product_name','LIKE','%')->get();
        return view('pages.index',compact('products','categories','lts_p','search'));
    }


    //===================product-details=====================
    public function productDetails($product_id){
        $product=Product::findOrFail($product_id);
        $category_id = $product->category_id;
        $related_p = Product::where('category_id',$category_id)->where('id','!=',$product_id)->latest()->get();
        return view('pages.product-details',compact('product','related_p'));
    }



    //=============================shop pages=================================



    public function shopPage(){
        $products = Product::latest()->get();
        $productsp = Product::latest()->paginate(9);
        $categories = Category::where('status',1)->latest()->get();
        return view('pages.shop',compact('products','categories','productsp'));
    }



    //====================category wise product show=================================

    public function catWiseProduct($cat_id){
        $products = Product::where('category_id',$cat_id)->latest()->paginate(9);
        $categories = Category::where('status',1)->latest()->get();
        return view('pages.cat-product',compact('products','categories'));

    }






    //===========================contactPage================================

    public function contact(){
        return view('pages.contact');
    }







   //=========================product search=============================

    
}
