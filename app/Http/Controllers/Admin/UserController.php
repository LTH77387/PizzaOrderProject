<?php

namespace App\Http\Controllers\Admin;


use App\Models\User;
use App\Models\Pizza;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;


class UserController extends Controller
{
    public function index(){
        $pizza=Pizza::where('publish_status',1)->get();
        if(count($pizza)==0){
            $emptyStatus=0;
        }else{
            $emptyStatus=1;
        }
        $data=Category::get();
        return view('user.home')->with(['pizza'=>$pizza,'categoryData' => $data,'count'=>$emptyStatus]);
    }
    public function getUserListPage(){
        $userData=User::where('role','=','user')->paginate(5);
 
        return view('admin.user.userList')->with(['userList'=>$userData]);
    }
    public function getAdminListPage(){
     $adminData=User::where('role','=','admin')->paginate(5);
 
        
     return view('admin.user.adminList')->with(['adminList'=>$adminData]);
    }
    public function userListDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['userListDelete'=>"User Data Deleted Successfully!"]);
    }
    public function adminListDelete($id){
        User::where('id',$id)->delete();
        return back()->with(['adminListDelete'=>"Admin Data Deleted Successfully!"]);
    }

    //user data search 
    public function userListSearch(Request $request){
        $response=$this->search('user',$request);
      return view('admin.user.userList')->with(['userList'=>$response]);
    }
    //admin data search
    public function adminListSearch(Request $request){
        $response=$this->search('admin',$request);
      return view('admin.user.adminList')->with(['adminList'=>$response]);
    }
public function categoryItem($id){
    $data=Pizza::select('pizzas.*','categories.category_name as categoryName')
    ->leftJoin('categories','pizzas.pizza_id','categories.category_id')
    ->where('pizzas.category_id',$id)
    ->paginate(5);

    return view('admin.category.item')->with(['categoryItem'=>$data]);
 
    
}
public function pizzaDetails($id){
  $data=Pizza::where('pizza_id',$id)->first();
  $pizzaData=Session::put('PIZZA_INFO',$data);

 return view('user.details') ->with(['pizzaDetails'=>$data]);
}
// public function userCreate(Request $request){
//     dd($request);
// }
// public function userSend(Request $request){
// $user=$this->requestUserData($request);
// dd($user);
// }
// private function requestUserData(Request $request){
//     return [
//         'user_id'=>$request->auth()->user()->id,
//         'name'=>$request->name,
//         'email'=>$request->email,
//         'message'=>$request->message,
//     ];
// }
public function userCategory($id){
//    $data=Pizza::select('pizzas.*','categories.category_name','categories.category_id')
//         ->leftJoin('categories','pizzas.pizza_id','categories.category_id')
//         ->where('pizza_id',$id)
// //         ->paginate(5);
//        $data=Pizza::where('category_id',$id)->paginate(5);
//    $category=Category::get();
//    return view('user.home')->with(['pizza'=>$data,'categoryData'=>$category]);
$pizza=Pizza::where('category_id',$id)
->where('publish_status',1)
->paginate(5);
if(count($pizza)==0){
    $emptyStatus=0;
}else{
    $emptyStatus=1;
}

        $data=Category::get();
        return view('user.home')->with(['pizza'=>$pizza,'categoryData' => $data,'count'=>$emptyStatus]);
   
}
public function userCategorySearch(Request $request){
  $data=Pizza::where('pizza_name','like','%' . $request->userCategorySearch . '%')->paginate(5);
  $category=Category::get();
  if(count($data)==0){
    $emptyStatus=0;
}else{
    $emptyStatus=1;
}
  return view('user.home')->with(['pizza'=>$data,'categoryData'=>$category,'count'=>$emptyStatus]);
}

public function dateSearch(Request $request){
    $min=$request->minPrice;
    $max=$request->maxPrice;
    $query=Pizza::select('*');
    if($min!==null && $max==null){
        $query=$query->where('price','>=',$min);
    }else if($min==null && $max!==null){
        $query=$query->where('price','<=',$max);
    }else if($min==null && $max==null){
        $query=$query->where('price','>=',$min)
                     ->where('price','<=',$max);
    }
    $query=$query->paginate(5);
    $query->appends($request->all());
    $status=count($query) == 0 ? 0 : 1;
    $category=Category::get();
    return view('user.home')->with(['pizza'=>$query,'categoryData'=>$category,'count'=>$status]);
}

    private function search($role,$request){
        $searchData=User::where('role',$role)->where(function ($query) use($request){
            $query->orWhere('name','like','%' . $request->ListSearch . '%')
            ->orWhere('email','like','%' . $request->ListSearch . '%')
            ->orWhere('phone','like','%' . $request->ListSearch . '%')
            ->orWhere('address','like','%' . $request->ListSearch . '%');
        })->paginate(3);
        $searchData->appends($request->all());
       
        return $searchData;
    }
}
