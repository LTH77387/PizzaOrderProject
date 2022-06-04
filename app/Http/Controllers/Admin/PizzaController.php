<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PizzaController extends Controller
{
    public function pizzaGet(){
        $data=Pizza::get();
        return view('admin.pizza.list')->with(['pizzaShow'=>$data]);
    }
    public function pizza(){
        $create=Category::get();
        return view('admin.pizza.create')->with(['create'=>$create]);
    }
    
    public function createPizza(Request $request){
       $data=$this->requestPizzaData($request);
     Pizza::create($data);
        return back()->with(['createPizza'=>"Pizza created successfully!"]);
    }
    private function requestPizzaData($request){
    return [
        'pizza_name'=>$request->name,
        'pizza_image'=>$request->image,
        'price'=>$request->price,
        'publish_status'=>$request->publish,
        'category_id'=>$request->category,
        'discount_price'=>$request->discount,
        'buy_one_get_one_status'=>$request->buyOneGetOne,
        'waiting_time'=>$request->waitingTime,
        'description'=>$request->description,
    ];
    }
    //delete 
public function deletePizza($id){
    Pizza::where('pizza_id',$id)->delete();
    return back()->with(['deletePizza'=>"Pizza Data deleted successfully!!"]);
}
}
