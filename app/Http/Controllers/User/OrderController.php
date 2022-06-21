<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;


use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    $validator = Validator::make($request->all(), [
        'pizzaCount'=>'required',
        'paymentType'=>'required',

     ]);

     if ($validator->fails()) {
         return back()
                     ->withErrors($validator)
                     ->withInput();
     }
   
    
    for($i=0;$i<$count;$i++){
        Order::create($getData);
    }
    $waitingTime=$pizzaInfo['waiting_time'] * $count;
    return back()->with(['totalTime'=>$waitingTime]);
    
 
    // return back()->with(['pizzaDetails'=>$waitingTime]);
   }
   public function adminOrder(Request $request){
    $data=Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
    ->join('users','users.id','orders.customer_id')
    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
    // ->orWhere('users.name','like','%' . $request->searchOrder.'%')
    // ->orWhere('pizzas.pizza_name','like','%' . $request->searchOrder.'%')
    ->groupBy('orders.customer_id','orders.pizza_id')
    ->paginate(5);
    Session::put('ORDER_DATA',$data);
    $data->appends($request->all());
    return view('admin.order.list')->with(['orderList'=>$data]);
   
}
   public function orderDownload(){
      if(Session::has('ORDER_DATA')){
        $data=Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
        ->join('users','users.id','orders.customer_id')
        ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
        ->orWhere('users.name','like','%' . Session::get('ORDER_DATA').'%')
        ->orWhere('pizzas.pizza_name','like','%' .  Session::get('ORDER_DATA').'%')
        ->groupBy('orders.customer_id','orders.pizza_id')
        ->get();
      }else{
        $data=Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
        ->join('users','users.id','orders.customer_id')
        ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
        // ->orWhere('users.name','like','%' . Session::get('ORDER_DATA').'%')
        // ->orWhere('pizzas.pizza_name','like','%' .  Session::get('ORDER_DATA').'%')
        ->groupBy('orders.customer_id','orders.pizza_id')
        ->get();
      }
      $csvExporter = new \Laracsv\Export();

      // $csvExporter->beforeEach(function ($user) {
      //     $user->created_at = $user->created_at->format('Y-m-d');
      // });

      $csvExporter->build($data, [
          'order_id' => 'Order ID',
          'customer_name'=>'Customer Name',
          'pizza_name'=>'Product Count',
          'count'=>'Pizza Count',
          'order_time'=>'Order Time',
          'created_at'=>'Created Date',
          'updated_at'=>'Updated Date',
      ]);

      $csvReader = $csvExporter->getReader();

      $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

      $filename = 'orderDownload.csv';

      return response((string) $csvReader)
          ->header('Content-Type', 'text/csv; charset=UTF-8')
          ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
   }
   public function searchOrder(Request $request){
    $data=Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
    ->join('users','users.id','orders.customer_id')
    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
    ->orWhere('users.name','like','%' . $request->searchOrder.'%')
    ->orWhere('pizzas.pizza_name','like','%' . $request->searchOrder.'%')
    ->groupBy('orders.customer_id','orders.pizza_id')
    ->paginate(5);
    $data->appends($request->all());
    Session::put('ORDER_DATA',$request->searchOrder);
    return view('admin.order.list')->with(['orderList'=>$data]);
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
