<?php

namespace App\Http\Controllers\Admin;

use auth;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function profile(){
        $id=auth()->user()->id;
        $userData=User::where('id',$id)->first();
        
        return view('admin.profile.index')->with(['profileShow'=>$userData]);
    }
    public function updateUserData($id,Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'phone'=>'required',
            'address'=>'required',
        ]);
 
        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
          $data=$this->requestUserData($request) ;
         User::where('id',$id)->update($data);
            return back()->with(['updateSuccess'=>"User Data updated successfully!!"]);
    }
    public function userChangePasswordPage(){
        return view('admin.profile.changePasswor');
    }
public function changePassword($id,Request $request){
    $validator = Validator::make($request->all(), [
        'oldPassword' => 'required',
        'newPassword' => 'required',
        'confirmPassword'=>'required',
      
    ]);

    if ($validator->fails()) {
        return back()
                    ->withErrors($validator)
                    ->withInput();
    }
// $data=$this->requestPasswordDta($request);
$oldPassword=$request->oldPassword;
$newPassword=$request->newPassword;
$confirmPassword=$request->confirmPassword;
$data=User::where('id',$id)->first();
$hashedPassword=$data['password'];
if(Hash::check($oldPassword,$hashedPassword)){
    if($newPassword != $confirmPassword){
        return back()->with(['notMatch'=>"Passwords do not match! Try Again..."]);
    }else{
        if(strlen($newPassword) <= 6 || strlen($confirmPassword) <= 6){
            return back()->with(['lengthErr'=>"Passwords Must Be Greater Than 6"]);
        }else{//change case
            $hash=Hash::make($newPassword);
            $data=[
                'password'=>$hash,
            ];
            User::where('id',$id)->update($data);
            return back()->with(['success'=>"Password Changed Successfully!!"]);
        }
    }
}else{
    return back()->with(['oldPasswordErr'=>"Old Password does not match"]);
}
}




public function adminOrder(Request $request){
    $data=Order::select('orders.*','users.name as customer_name','pizzas.pizza_name as pizza_name',DB::raw('COUNT(orders.pizza_id) as count'))
    ->join('users','users.id','orders.customer_id')
    ->join('pizzas','pizzas.pizza_id','orders.pizza_id')
    // ->orWhere('users.name','like','%' . $request->searchOrder.'%')
    // ->orWhere('pizzas.pizza_name','like','%' . $request->searchOrder.'%')
    ->groupBy('orders.customer_id','orders.pizza_id')
    ->paginate(5);
    $data->appends($request->all());
    return view('admin.order.list')->with(['orderList'=>$data]);
   
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
    return view('admin.order.list')->with(['orderList'=>$data]);
}
    
    private function requestUserData($request){
        return [
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'address'=>$request->address,

        ];
    }
 
}
