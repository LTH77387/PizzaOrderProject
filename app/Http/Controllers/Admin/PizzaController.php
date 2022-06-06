<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    public function pizzaGet(){

        $data=Pizza::paginate(5);
        if(count($data)==0){
            $emptyStauts=0;
        }else{
            $emptyStauts=1;
        }
        return view('admin.pizza.list')->with(['pizzaShow'=>$data,'status'=>$emptyStauts]);
    }
    public function pizza(){
        $create=Category::get();
        return view('admin.pizza.create')->with(['create'=>$create]);
    }
    
    public function createPizza(Request $request){
        $file=$request->file('image');
       
        $fileName=uniqid() . '_' . $file->getClientOriginalName();
      
        $file->move(public_path() . '/uploads/' , $fileName);

       $data=$this->requestPizzaData($request,$fileName);
     Pizza::create($data);
        return back()->with(['createPizza'=>"Pizza created successfully!"]);
    }
 
    //delete 
public function deletePizza($id){
    $data=Pizza::select('pizza_image')->where('pizza_id',$id)->first();
    $fileName=$data['pizza_image'];
    Pizza::where('pizza_id',$id)->delete();
    if(File::exists(public_path() . '/uploads/' . $fileName)){
            File::delete(public_path() . '/uploads/' . $fileName);
    }
    return back()->with(['deletePizza'=>"Pizza Data deleted successfully!!"]);
}
private function requestPizzaData($request,$fileName){
    return [
        'pizza_name'=>$request->name,
        'pizza_image'=>$fileName,
        'price'=>$request->price,
        'publish_status'=>$request->publish,
        'category_id'=>$request->category,
        'discount_price'=>$request->discount,
        'buy_one_get_one_status'=>$request->buyOneGetOne,
        'waiting_time'=>$request->waitingTime,
        'description'=>$request->description,
    ];
    }
    public function pizzaEdit($id){
        // $category= Category::where('category_id',$id)->first();
       
        // $data=Pizza::select('pizzas.*','categories.category_id','categories.category_name')
        // ->join('categories','pizzas.category_id','=','categories.category_id')
        // ->where('pizza_id',$id)
        // ->first();
    // $data=Pizza::where('pizza_id',$id)->first();
    $create=Category::get();
    $pizza=Pizza::where('pizza_id',$id)->first();
    // $data=Pizza::select('pizzas.*','categories.category_name','categories.category_id')
    //         ->join('categories','pizzas.category_id','=','categories.category_id')
    //         ->where('pizza_id',$id)
    //         ->first();
    //         dd($data->category_name);
    return view('admin.pizza.edit')->with(['create'=>$create,'pizzaEdit'=>$pizza]);
    
    }
   
    public function pizzaInfo($id){
        $data=Pizza::where('pizza_id',$id)->first();
        return view('admin.pizza.pizzaInfo')->with(['pizzaInfo'=>$data]);
    }
 public function edit($id,Request $request){
  $validator = Validator::make($request->all(), [
           
            'name'=>'required',
            'image'=>'required',
            'description'=>'required',
            'price'=>'required',
            'publish'=>'required',
            // 'category'=>'required',
            'discount'=>'required',
            'waitingTime'=>'required',
        ]);
 
        if ($validator->fails()) {
            return    back()
                        ->withErrors($validator)
                        ->withInput();
                      
        }


      
       
     

        
 }
 public function editData($id){
  
 }
   
}
