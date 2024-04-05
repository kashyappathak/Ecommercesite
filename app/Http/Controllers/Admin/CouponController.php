<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
 
    public function index(){
        $coupons = Coupon::all();
        return view('admin.coupons.index', compact('coupons'));
    }

    public function create(){
        return view('admin.coupons.create');
    }

    public function store(Request $request){
        Validator::make($request->all(),[
            'coupon_name'=>'required',
            'discount'=>'required'
        ])->validated();

        Coupon::insert([
            'coupon_name'=> strtoupper($request->coupon_name),
            'discount'=> $request->discount,
            'created_at'=> Carbon::now(),
        ]);


        return redirect()->route('coupons.index')->with('message','Coupen Added Successfully');
    }

    public function edit($id){

        $coupon = Coupon::findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(Request $request , $id){

        $coupon = Coupon::find($id);
        $coupon->coupon_name = strtoupper($request->coupon_name);
        $coupon->discount = $request->discount;
        $coupon->created_at = Carbon::parse($request->created_at); // Assuming $request->created_at contains the new date
        $coupon->update();

        return redirect()->route('coupons.index')->with('message','Coupen updated Successfully');

    }

    public function destroy($id){

        $coupon = Coupon::find($id);
        $coupon->delete();

        return redirect()->route('coupons.index')->with('message', 'Coupon Deleted Successfully!!');

    }
    public function Inactive($id){

        Coupon::find($id)->update(['status'=> 0]);
        return redirect()->back()->with('status' ,'Coupon Status is  inactivated!!');
    }

    public function Active($id){
        Coupon::find($id)->update(['status'=> 1]);
        return redirect()->back()->with('status', 'Coupon Status is activated!!');
    }
}
