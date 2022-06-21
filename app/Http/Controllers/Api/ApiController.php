<?php

namespace App\Http\Controllers\Api;
use Carbon\Carbon;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;


class ApiController extends Controller
{
public function categoryDelete($id){
//  $request->validate([
//        'id'=>'required',
//        'categoryName'=>'required|string',
       
//    ]);
$data=Category::where('category_id',$id)->first();
if(empty($data)){
    return Response::json([
        'message'=>'error!',
        'data'=>$data,
    ]);
}else{
    $data=Category::where('category_id',$id)->delete();
return Response::json([
    'status'=>200,
    'message'=>'success!',

]);
}

}
public function categoryUpdate(Request $request){
    $updateData=[
        'category_id'=>$request->id,
        'category_name'=>$request->categoryName,
        'updated_at'=>Carbon::now(),
    ];
    if(!empty($updateData)){
        Category::where('category_id',$request->id)->update($updateData);
       
        return Response::json([
            'status'=>200,
            'message'=>'update success',
        ]);
    }else{
        return Response::json([
            'message'=>'error!',
        ]);
    }
    
}
public function categoryData(){
    $data=Category::get();
    return Response::json([
        'status'=>200,
        'message'=>"showing category data",
        'data'=>$data,
    ]);
}
}
