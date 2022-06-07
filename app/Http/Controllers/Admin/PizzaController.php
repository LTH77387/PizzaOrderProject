<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function pizzaEdit($id){
      
        $create=Category::get();
        // return $create;
// dd($create->category_id);
        $users = Pizza::select('pizzas.*','categories.category_id','categories.category_name')
        ->join('categories','pizzas.category_id','=','categories.category_id')
        ->where('pizza_id',$id)
            ->get();
       $data=Pizza::where('pizza_id',$id)->first();
        // $pizza=Pizza::where('pizza_id',$id)->first();
        return view('admin.pizza.edit')->with(['category'=>$create,'pizzaEdit'=>$data]);

        // $category= Category::where('category_id',$id)->first();
       
        // $data=Pizza::
        // 
        // ->where('pizza_id',$id)
        // ->first();
    // $data=Pizza::where('pizza_id',$id)->first();
  
    // $data=Pizza::select('pizzas.*','categories.category_name','categories.category_id')
    //         ->join('categories','pizzas.category_id','=','categories.category_id')
    //         
    //         ->first();
    //         dd($data->category_name);
    
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
 //update
 public function editData($id, Request $request){
 
    $updateData=$this->getUpdateData($request);
   if($updateData['image']){
    
        $data=Pizza::select('pizza_image')->where('pizza_id',$id)->first();
        $fileName=$data['pizza_image'];
       
        if(File::exists(public_path().'/uploads/'.$fileName)){
     File::delete(public_path().'/uploads/'.$fileName);

     }
   //get new img data
     $file=$request->file('pizza_image');
     $fileName=uniqid().'_' . $file->getClientOriginalName();
    
     $file->move(public_path() . '/uploads/' , $fileName);
     $updateData['pizza_image']=$fileName;
 
    Pizza::where('pizza_id',$id)->update($updateData);
    // return redirect()->route('pizzaGet');
      }
    //   else{
    //     Pizza::where('pizza_id',$id)->update($updateData);
    //     return redirect()->route('pizzaGet');
    //   }
 
//    }else{
//          
//      return redirect()->route('pizzaGet')->with(['pizzaUpdateSuccess'=>"Pizza data updated successfully!!"]);
//    }
//    else{
//        Pizza::where('pizza_id',$id)->update($updateData);
//        return view('admin.pizza.list');
//    }
 
//     $update=$this->getUpdateData($request,$fileName);
//   if(isset($update['image'])){
//       $data=Pizza::select('image')->where('pizza_id',$id)->first();
//     $fileName=$data['image'];
//   
//   //get new image data
//   $file=$request->file('image');
//   
//  
  
//   $update['image']=$fileName;
//   Pizza::where('pizza_id',$id)->update($update);
//   return view('admin.pizza.list')->with(['updateSuccess'=>"Pizza Data are updated successfully!!"]);
//   }
//   else{
//       Pizza::where('pizza_id',$id)->update($update);
//       return redirect()->route('pizzaGet')->with(['updatePizza'=>"Updated data successfully!"]);
//   }
//  $data=[
//     'pizza_name'=>$request->name,
//     'pizza_image'=>$fileName,
//     'price'=>$request->price,
//     'publish_status'=>$request->publish,
//     'category_id'=>$request->category,
//     'discount_price'=>$request->discount,
//     'buy_one_get_one_status'=>$request->buyOneGetOne,
//     'waiting_time'=>$request->waitingTime,
//     'description'=>$request->description,
// ];



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
    private function getUpdateData($request){
        $arr=[
            'pizza_name'=>$request->name,
       
        'price'=>$request->price,
        'publish_status'=>$request->publish,
        'category_id'=>$request->category,
        'discount_price'=>$request->discount,
        'buy_one_get_one_status'=>$request->buyOneGetOne,
        'waiting_time'=>$request->waitingTime,
        'description'=>$request->description,


        ];
        if(isset($request->pizza_image)){
            $arr['pizza_image']=$request->image;
        }
        
    }



}
