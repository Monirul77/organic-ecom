<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Http\middleware;
use Illuminate\Http\Request;

class categoryController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');

         
    }
  

    public function index(){
        //$categories= Category::latest()->get();
        $categories= Category::latest()->get();

        return view('admin.category.index',compact('categories'));
    }

     // ============ store category ========= 
     public function StoreCat(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ]);
        
       
        Category::create([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->back()->with('success','Category added');
    }
    // ========= edit category data 
    public function Edit($cat_id){
        $category = Category::find($cat_id);
        return view('admin.category.edit',compact('category'));
    }

    // ============ UpdateCat category ========= 
    public function UpdateCat(Request $request){      
        $cat_id = $request->id;

        Category::find($cat_id)->update([
            'category_name' => $request->category_name,
            'updated_at' => Carbon::now()
        ]);

        return Redirect()->route('Admin.category')->with('Catupdated','Category Updated');
    }
    public function Delete($cat_id){
        $categories=Category::find($cat_id);
        $categories->delete();
        return redirect()->back()->with('delete','You have deleted successfully');

    }
    // status inactive 
    public function Inactive($cat_id){
        Category::find($cat_id)->update(['status' => 0]);
        return Redirect()->back()->with('Catupdated','Category Inactived');
    }

    
    // status active 
    public function Active($cat_id){
        Category::find($cat_id)->update(['status' => 1]);
        return Redirect()->back()->with('Catupdated','Category Activated');
    }



}
