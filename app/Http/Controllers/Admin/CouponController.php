<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $coupons = Coupon::latest()->get();
        return view('admin.coupon.index', compact('coupons'));
    }

    //================Coupon store=======================

    public function CouponStore(Request $request)
    {
        Coupon::create([
            'coupon_name' => strtoupper($request->coupon_name),
            'discount' => $request->discount,
            'created_at' => Carbon::now(),
        ]);

        return Redirect()->back()->with('success', 'Coupon added');
    }

    //=====================edit coupon===================

    public function couponEdit($coupon_id){
        $coupon = Coupon::findOrFail($coupon_id);
        return view('admin.coupon.edit',compact('coupon'));
    }


    //===================update coupon=====================

    public function CouponUpdate(Request $request){
       $coupon_id=$request->id;
       Coupon::findOrFail($coupon_id)->update([
        'coupon_name' => strtoupper($request->coupon_name),
        'discount' => $request->discount,
           'updated_at' => Carbon::now()
       ]);
       return Redirect()->route('admin-coupon')->with('status','Coupon Updated');
    }

   //========================destroy==========================

    public function destroy($coupon_id)
    {
        $coup = Coupon::find($coupon_id);
        $coup->delete();
        return redirect()->back()->withwith('delete', 'You have deleted successfully');
    }

    //=========================inactive coupon======================

    public function InActive($coupon_id){
     Coupon::find($coupon_id)->update(['status'=>'0' ]);
     return redirect()->back()->with('status','coupon Inactive now');
    }

    //===================active=========================

    public function active($coupon_id){
        Coupon::find($coupon_id)->update(['status'=>'1' ]);
        return redirect()->back()->with('status','coupon active now');
       }
}
