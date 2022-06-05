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
    public function pizzaEdit($id,Request $request){
        // $validator = Validator::make($request->all(), [
        //     'title' => 'required|unique:posts|max:255',
        //     'body' => 'required',
        //     'name'=>'required',
        //     'image'=>'required',
        //     'descriptioon'=>'required',
        //     'publish'=>'required',
        //     // 'category'=>'required',
        //     'discount'=>'required',
        //     'waitingTime'=>'required',
        // ]);
 
        // if ($validator->fails()) {
        //     return      redirect()->route('pizzaEdit')
        //                 ->withErrors($validator)
        //                 ->withInput();
        // }
        $data=Pizza::where('pizza_id',$id)->first();
        return view('admin.pizza.edit')->with(['pizzaEdit'=>$data]);
    }
   
    public function pizzaInfo($id){
        $data=Pizza::where('pizza_id',$id)->first();
        return view('admin.pizza.pizzaInfo')->with(['pizzaInfo'=>$data]);
    }
    // public function editPizza(){
    //     return view('admin.pizza.edit');
    // }
}
