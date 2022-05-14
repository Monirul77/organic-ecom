<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Http\Controllers\Controller;
 
use Carbon\Carbon;
use Illuminate\Http\Request;

class BrandController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $brands = Brand::latest()->get();
          
        return view('admin.brand.index', compact('brands'));
    }

    // ============ store brand ========= 
    public function Store(Request $request)
    {
        $request->validate([
            'brand_name' => 'required|unique:brands,brand_name'
        ]);


        Brand::create([
            'brand_name' => $request->brand_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success', 'Brand added');
    }


    // =============== edit data  ========== 
    public function edit($brand_id)
    {
        $brand = Brand::find($brand_id);
        return view('admin.brand.edit', compact('brand'));
    }

    //=========Update brand===========
    
    public function update(Request $request){
        $request->validate([
            'brand_name' => 'required'
        ]);
        $brand_id = $request->id;
       
        Brand::find($brand_id)->update([
            'brand_name' => $request->brand_name,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->route('Admin.brand')->with('success','Brand Updated');
    }

     //=========delete=========

    public function delete($brand_id){
        Brand::find($brand_id)->delete();
        return Redirect()->back()->with('delete','Brand Deleted Success');
    } 

    public function inActive($brand_id){
       Brand::find($brand_id)->update(['status'=>'0']);
       return Redirect()->back()->with('success','you have Inactived brand');
    }
    
    public function active($brand_id){
        Brand::find($brand_id)->update(['status'=>'1']);
        return Redirect()->back()->with('success','you have actived brand');
        
     }
 

     
     

}
