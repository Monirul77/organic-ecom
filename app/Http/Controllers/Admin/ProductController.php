<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Brand;
use Intervention\Image\Facades\Image;
//use Image;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function addProduct()
    {
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.add', compact('categories', 'brands'));
    }

    //============================store product===========================


    public function storeProduct(Request $request)
    {
        $request->validate([
            'product_name' => 'required|max:255',
            'product_code' => 'required|max:255',
            'price' => 'required|max:255',
            'product_quantity' => 'required|max:255',
            'category_id' => 'required|max:255',
            'brand_id' => 'required|max:255',
            'short_description' => 'required',
            'long_description' => 'required',
            'image_one' => 'required|mimes:jpg,jpeg,png,gif',
            'image_two' => 'required|mimes:jpg,jpeg,png,gif',
            'image_three' => 'required|mimes:jpg,jpeg,png,gif',
        ], [
            'category_id.required' => 'select category name',
            'brand_id.required' => 'select brand name',
        ]);

        $imag_one = $request->file('image_one');
        $name_gen = hexdec(uniqid()) . '.' . $imag_one->getClientOriginalExtension();
        Image::make($imag_one)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
        $img_url1 = 'fontend/img/product/upload/' . $name_gen;

        $imag_two = $request->file('image_two');
        $name_gen = hexdec(uniqid()) . '.' . $imag_two->getClientOriginalExtension();
        Image::make($imag_two)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
        $img_url2 = 'fontend/img/product/upload/' . $name_gen;

        $imag_three = $request->file('image_three');
        $name_gen = hexdec(uniqid()) . '.' . $imag_three->getClientOriginalExtension();
        Image::make($imag_three)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
        $img_url3 = 'fontend/img/product/upload/' . $name_gen;


        Product::create([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'price' => $request->price,
            'product_quantity' => $request->product_quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'image_one' => $img_url1,
            'image_two' => $img_url2,
            'image_three' => $img_url3,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Product Added');
    }


    //========================manageProduct==========================

    public function manageProduct()
    {
        // $manage=Product::latest()->get();
        $products = Product::orderBy('id', 'DESC')->get();
        return view('admin.product.manage', compact('products'));
    }


    //===============edit product=======================

    public function editProduct($product_id)
    {
        $product = Product::findOrFail($product_id);
        $categories = Category::latest()->get();
        $brands = Brand::latest()->get();
        return view('admin.product.edit', compact('product', 'categories', 'brands'));
    }


    //====================update product================

    public function updateProduct(Request $request)
    {
        $product_id = $request->id;
        Product::findOrFail($product_id)->update([
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'product_name' => $request->product_name,
            'product_slug' => strtolower(str_replace(' ', '-', $request->product_name)),
            'product_code' => $request->product_code,
            'price' => $request->price,
            'product_quantity' => $request->product_quantity,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,

            'created_at' => Carbon::now(),
        ]);

        return Redirect()->route('manage.products')->with('success', 'Product successfully Updated');
    }

    //=====================update image=========================

    public function updateImage(Request $request)
    {
        $product_id = $request->id;
        $old_one = $request->img_one;
        $old_two = $request->img_two;
        $old_three = $request->img_three;


 
        if ($request->has('image_one') && ($request->has('image_two')) && ($request->has('imge_three'))) 
        {
            unlink($old_one);
            unlink($old_two);
            unlink($old_three);

            $imag_one = $request->file('image_one');
            $name_gen = hexdec(uniqid()) . '.' . $imag_one->getClientOriginalExtension();
            Image::make($imag_one)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
            $img_url1 = 'fontend/img/product/upload/' . $name_gen;

            $imag_two = $request->file('image_two');
            $name_gen = hexdec(uniqid()) . '.' . $imag_two->getClientOriginalExtension();
            Image::make($imag_two)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
            $img_url2 = 'fontend/img/product/upload/' . $name_gen;

            $imag_three = $request->file('image_three');                
            $name_gen = hexdec(uniqid()).'.'.$imag_three->getClientOriginalExtension();
            Image::make($imag_three)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
            $img_url3 = 'fontend/img/product/upload/'.$name_gen;


            Product::findOrFail($product_id)->update([
                'image_one' => $img_url1,
                'image_two' => $img_url2,
                'image_three'=>$img_url3,
                'updated_at' => Carbon::now(),
            ]);

            return Redirect()->route('manage.products')->with('success', 'image successfully Updated');
        }
  // image one and two change


  if ($request->has('image_one') && ($request->has('image_two'))) 
  {
      unlink($old_one);
      unlink($old_two);
     

      $imag_one = $request->file('image_one');
      $name_gen = hexdec(uniqid()) . '.' . $imag_one->getClientOriginalExtension();
      Image::make($imag_one)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
      $img_url1 = 'fontend/img/product/upload/' . $name_gen;

      $imag_two = $request->file('image_two');
      $name_gen = hexdec(uniqid()) . '.' . $imag_two->getClientOriginalExtension();
      Image::make($imag_two)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
      $img_url2 = 'fontend/img/product/upload/' . $name_gen;

      


      Product::findOrFail($product_id)->update([
          'image_one' => $img_url1,
          'image_two' => $img_url2,
          'updated_at' => Carbon::now(),
      ]);

      return Redirect()->route('manage.products')->with('success', 'image successfully Updated');
  }


  // image one and three
   
  if ($request->has('image_one') && ($request->has('image_three'))) 
  {
      unlink($old_one);
      unlink($old_three);
     

      $imag_one = $request->file('image_one');
      $name_gen = hexdec(uniqid()) . '.' . $imag_one->getClientOriginalExtension();
      Image::make($imag_one)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
      $img_url1 = 'fontend/img/product/upload/' . $name_gen;

      $imag_three = $request->file('image_three');
      $name_gen = hexdec(uniqid()) . '.' . $imag_three->getClientOriginalExtension();
      Image::make($imag_three)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
      $img_url3 = 'fontend/img/product/upload/' . $name_gen;

      


      Product::findOrFail($product_id)->update([
          'image_one' => $img_url1,
          'image_three' => $img_url3,
          'updated_at' => Carbon::now(),
      ]);

      return Redirect()->route('manage.products')->with('success', 'image successfully Updated');
  }

  //two and three

  if ($request->has('image_two') && ($request->has('image_three'))) 
  {
      unlink($old_two);
      unlink($old_three);
     

      $imag_two = $request->file('image_two');
      $name_gen = hexdec(uniqid()) . '.' . $imag_two->getClientOriginalExtension();
      Image::make($imag_two)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
      $img_url2 = 'fontend/img/product/upload/' . $name_gen;

      $imag_three = $request->file('image_three');
      $name_gen = hexdec(uniqid()) . '.' . $imag_three->getClientOriginalExtension();
      Image::make($imag_three)->resize(270, 270)->save('fontend/img/product/upload/' . $name_gen);
      $img_url3 = 'fontend/img/product/upload/' . $name_gen;

      


      Product::findOrFail($product_id)->update([
          'image_two' => $img_url2,
          'image_three' => $img_url3,
          'updated_at' => Carbon::now(),
      ]);

      return Redirect()->route('manage.products')->with('success', 'image successfully Updated');
  }


       
        if ($request->has('image_one')) {
            unlink($old_one);
            $imag_one = $request->file('image_one');                
             $name_gen = hexdec(uniqid()).'.'.$imag_one->getClientOriginalExtension();
             Image::make($imag_one)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
             $img_url1 = 'fontend/img/product/upload/'.$name_gen;
 
             Product::findOrFail($product_id)->update([
                 'image_one' => $img_url1,
                 'updated_at' => Carbon::now(),
             ]);
 
             return Redirect()->route('manage.products')->with('success','image successfully Updated');
         }
 
         if ($request->has('image_two')) {
             unlink($old_two);
             $imag_one = $request->file('image_two');                
              $name_gen = hexdec(uniqid()).'.'.$imag_one->getClientOriginalExtension();
              Image::make($imag_one)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
              $img_url1 = 'fontend/img/product/upload/'.$name_gen;
  
              Product::findOrFail($product_id)->update([
                  'image_two' => $img_url1,
                  'updated_at' => Carbon::now(),
              ]);
  
              return Redirect()->route('manage.products')->with('success','image successfully Updated');
          }
 
          if ($request->has('image_three')) {
             unlink($old_three);
             $imag_three = $request->file('image_three');                
              $name_gen = hexdec(uniqid()).'.'.$imag_three->getClientOriginalExtension();
              Image::make($imag_three)->resize(270,270)->save('fontend/img/product/upload/'.$name_gen);       
              $img_url3 = 'fontend/img/product/upload/'.$name_gen;
  
              Product::findOrFail($product_id)->update([
                  'image_three' => $img_url3,
                  'updated_at' => Carbon::now(),
              ]);
  
              return Redirect()->route('manage.products')->with('success','image successfully Updated');
          }
    }

      

      //============================product delete========================



       public function destroy($product_id)
       {
             $imag= Product::findOrFail($product_id);
             $img_one=$imag->image_one;
             $img_two=$imag->image_two;
             $img_three=$imag->image_three;

             unlink($img_one);
             unlink($img_two);
             unlink($img_three);

         Product::findOrFail($product_id)->delete();
         return Redirect()->back()->with('delete','successfully Deleted');
       }
    

       //=====================product inactive==========================

       public function inActive($product_id){
       Product::findOrFail($product_id)->update(['status'=>'0']);
       return Redirect()->back()->with('status','product Inactived');
       }

       //======================product active====================

       public function active($product_id){
        Product::findOrFail($product_id)->update(['status'=>'1']);
        return Redirect()->back()->with('status','Product actived');
        }
}
