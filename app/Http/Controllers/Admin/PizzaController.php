<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PizzaController extends Controller
{
    public function pizzaGet(){
        if(Session::has('PIZZA_SEARCH')){
            Session::forget('PIZZA_SEARCH');
        }
        $data=Pizza::paginate(3);
        if(count($data)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        return view('admin.pizza.list')->with(['pizzaShow'=>$data,'status'=>$emptyStatus]);
    }
    public function pizza(){
        $create=Category::get();
        return view('admin.pizza.create')->with(['create'=>$create]);
    }
    
    public function createPizza(Request $request){
        $validator = Validator::make($request->all(), [
           
            'name'=>'required',
            'image'=>'required',
            'description'=>'required',
            'price'=>'required',
            'publish'=>'required',
            'category'=>'required',
            'discount'=>'required',
            'waitingTime'=>'required',
        ]);
 
        if ($validator->fails()) {
            return    back()
                        ->withErrors($validator)
                        ->withInput();
                      
        }
        $file=$request->file('image');
       
        $fileName=uniqid() . '_' . $file->getClientOriginalName();
      
        $file->move(public_path() . '/uploads/' , $fileName);

       $data=$this->requestPizzaData($request,$fileName);
     Pizza::create($data);
        return back()->with(['createPizza'=>"Pizza created successfully!"]);
    }
 
    //delete 
public function deletePizza($id){
    $data=Pizza::select('image')->where('pizza_id',$id)->first();
    $fileName=$data['image'];
    Pizza::where('pizza_id',$id)->delete();
    if(File::exists(public_path() . '/uploads/' . $fileName)){
            File::delete(public_path() . '/uploads/' . $fileName);
    }
    return back()->with(['deletePizza'=>"Pizza Data deleted successfully!!"]);
}

    public function pizzaEdit($id){
      
        $create=Category::get();
        $users = Pizza::select('pizzas.*','categories.category_id','categories.category_name')
        ->join('categories','pizzas.category_id','=','categories.category_id')
        ->where('pizza_id',$id)
            ->first();
         
     
        
        return view('admin.pizza.edit')->with(['category'=>$create,'pizzaEdit'=>$users]);

       
    
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
            'category'=>'required',
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
 public function updatePizza($id, Request $request){
    $validator = Validator::make($request->all(), [
           
        'name'=>'required',
        // 'image'=>'required',
        'description'=>'required',
        'price'=>'required',
        'publish'=>'required',
        'category'=>'required',
        'discount'=>'required',
        'waitingTime'=>'required',
    ]);

    if ($validator->fails()) {
        return    back()
                    ->withErrors($validator)
                    ->withInput();
                  
    }
 $updateData=$this->requestUpdatePizzaData($request);
if(isset($updateData['image'])){
    $data=Pizza::select('image')->where('pizza_id',$id)->first();
   
    $fileName=$data['image'];
    // dd($fileName);
    if(File::exists(public_path() . '/uploads/' . $fileName)){
        File::delete(public_path() . '/uploads/' . $fileName);
     
        //get new img data
        $file=$request->file('image');
  
        $fileName=uniqid() . '_' . $file->getClientOriginalName();
    
        $file->move(public_path() . '/uploads/' , $fileName);
 
        $updateData['image']=$fileName;
     
        Pizza::where('pizza_id',$id)->update($updateData);
return redirect()->route('pizzaGet')->with(['updatePizzaData'=>"Pizza data updated successfully!"]);
      
}
}
else{
  
    Pizza::where('pizza_id',$id)->update($updateData);
  
    return redirect()->route('pizzaGet')->with(['updatePizzaData'=>"Pizza data updated successfully!"]);
}

 }
 //search pizza data
 public function pizzaSearch(Request $request){
        $searchKey=$request->table_search;
      $searchData=Pizza::orWhere('pizza_name','like','%' . $searchKey . '%')
      ->orWhere('price',$searchKey)
      ->paginate(3);
      Session::put('PIZZA_SEARCH',$searchKey);
      $searchData->appends($request->all());
      if(count($searchData)==0){
          $emptyStatus=0;
      }else{
          $emptyStatus=1;
      }
    
      return view('admin.pizza.list')->with(['status'=>$emptyStatus,'pizzaShow'=>$searchData]);
}
public function pizzaDownload(){
   if(Session::has('PIZZA_SEARCH')){
    $pizza=Pizza::orWhere('pizza_name','like','%' . Session::get('PIZZA_SEARCH') . '%')
    ->orWhere('price',Session::get('PIZZA_SEARCH'))
    ->get();
  
   }else{
       $pizza=Pizza::get();
   }
   $csvExporter = new \Laracsv\Export();

   // $csvExporter->beforeEach(function ($user) {
   //     $user->created_at = $user->created_at->format('Y-m-d');
   // });

   $csvExporter->build($pizza, [
       'pizza_id' => 'Pizza ID',
       'pizza_name'=>'Pizza Name',
       'description'=>'Description',
       'price'=>'Pizza Price',
       'publish_status'=>'Publish Status',
       'buy_one_get_one_status'=>'Buy 1 Get 1',
       'created_at'=>'Created Date',
       'updated_at'=>'Updated Date',
   ]);

   $csvReader = $csvExporter->getReader();

   $csvReader->setOutputBOM(\League\Csv\Reader::BOM_UTF8);

   $filename = 'pizzaDownload.csv';

   return response((string) $csvReader)
       ->header('Content-Type', 'text/csv; charset=UTF-8')
       ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
}
 private function requestUpdatePizzaData($request){
    $arr=[
        'pizza_name'=>$request->name,
        'price'=>$request->price,
        'publish_status'=>$request->publish,
        'category_id'=>$request->category,
        'discount_price'=>$request->discount,
        'buy_one_get_one_status'=>$request->buy_one_get_one_status,
        'waiting_time'=>$request->waitingTime,
        'description'=>$request->description,
    ];
 
     if(isset($request->image)){
       $arr['image']=$request->image;
     }
     return $arr;
 }
 private function requestPizzaData($request,$fileName){
    return [
        'pizza_name'=>$request->name,
        'image'=>$fileName,
        'price'=>$request->price,
        'publish_status'=>$request->publish,
        'category_id'=>$request->category,
        'discount_price'=>$request->discount,
        'buy_one_get_one_status'=>$request->buy_one_get_one_status,
        'waiting_time'=>$request->waitingTime,
        'description'=>$request->description,
    ];
    }



}
