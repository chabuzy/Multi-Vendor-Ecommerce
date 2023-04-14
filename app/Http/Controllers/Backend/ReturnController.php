<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;

class ReturnController extends Controller
{
   public function ReturnRequest(){

        $orders = Order::where('return_order',1)->orderBy('id','DESC')->get();
        return view('backend.return_order.return_request',compact('orders'));

    } // End Method 

    public function ReturnRequestApproved($order_id){

        Order::where('id',$order_id)->update(['return_order' => 2]);

        $notification = array(
            'message' => 'Return Order Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification); 

    } // End Method

    public function CompleteReturnRequest(){

        $orders = Order::where('return_order',2)->orderBy('id','DESC')->get();
        return view('backend.return_order.complete_return_request',compact('orders'));

    } // End Method 

    public function SearchByMonth(Request $request){

        $month = $request->month;
        $year = $request->year_name;

        $orders = Order::where('order_month',$month)->where('order_year',$year)->latest()->get();
        return view('backend.report.report_by_month',compact('orders','month','year'));

    }// End Method 

    public function SearchByYear(Request $request){ 

        $year = $request->year;

        $orders = Order::where('order_year',$year)->latest()->get();
        return view('backend.report.report_by_year',compact('orders','year'));

    }// End Method 

}
