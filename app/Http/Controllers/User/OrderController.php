<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
   public function order(){
       $pizzaInfo=Session::get('PIZZA_INFO');
   
     

       return view('user.order.placeOrder')->with(['pizzaDetails' => $pizzaInfo]);
   }
   public function placeOrder(Request $request){
    $pizzaInfo=Session::get('PIZZA_INFO');
$userId=auth()->user()->id;
 $count=$request->pizzaCount;
    $getData=$this->getOrderData($request,$pizzaInfo,$userId);
  
   
    
    for($i=0;$i<$count;$i++){
        Order::create($getData);
    }
    $waitingTime=$pizzaInfo['waiting_time'] * $count;
    return back()->with(['totalTime'=>$waitingTime]);
    
 
    // return back()->with(['pizzaDetails'=>$waitingTime]);
   }
   private function getOrderData($request,$pizzaInfo,$userId){
       return [
        'customer_id'=>$userId,
        'pizza_id'=>$pizzaInfo['pizza_id'],
        'carrier_id'=>0,
        'payment_status'=>$request->paymentType,
        'order_time'=>Carbon::now(),
        

       ];
   }
}
